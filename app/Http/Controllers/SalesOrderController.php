<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Inventory;
use App\Models\InventoryClient;
use DataTables;
use DB;

class SalesOrderController extends Controller
{
    // Show the sales orders page
    public function index()
    {
        $clients = InventoryClient::orderBy('name')->get();
        $inventory = Inventory::orderBy('Product')->get();

        return view('sales_orders.index', compact('clients', 'inventory'));
    }

    // AJAX for DataTables
    public function ajax(Request $request)
    {
        $data = SalesOrder::with('client')->orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('client_name', fn($row) => $row->client ? $row->client->name : 'N/A')
            ->addColumn('total_amount', fn($row) => number_format($row->total_amount, 2))
            ->addColumn('status', fn($row) => ucfirst($row->status))
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-order" data-id="' . $row->id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-order" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Store new sales order
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:inventory_clients,id',
            'order_date' => 'required|date',
            'items' => 'required|string',
            'status' => 'required|in:Pending,Completed,Cancelled',
        ]);

        $items = json_decode($request->items, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid items format.'], 422);
        }

        DB::beginTransaction();
        try {
            $order = SalesOrder::create([
                'g_id' => auth_id(),
                'client_id' => $request->client_id,
                'order_date' => $request->order_date,
                'total_amount' => 0,
                'status' => $request->status,
                'payment_status' => 'pending',
            ]);

            $totalAmount = 0;

            foreach ($items as $item) {
                $inventory = Inventory::findOrFail($item['inventory_id']);

                // Only deduct stock if order is Completed
                if ($request->status === 'Completed') {
                    if ($inventory->Stock < $item['quantity']) {
                        DB::rollBack();
                        return response()->json(['error' => "Not enough stock for {$inventory->Product}"], 422);
                    }
                    // Deduct stock and log
                    $this->adjustStock($inventory, -$item['quantity'], 'sale', "Order #{$order->id} Completed");

                    // $inventory->Stock -= $item['quantity'];
                    // $inventory->save();
                }

                $totalPrice = $inventory->SalePrice * $item['quantity'];

                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'inventory_id' => $inventory->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $inventory->SalePrice,
                    'total_price' => $totalPrice,
                ]);

                $totalAmount += $totalPrice;
            }

            $order->total_amount = $totalAmount;
            $order->save();

            DB::commit();
            return response()->json(['success' => 'Sales order created successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    // Show single order
    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load('client', 'items.inventory');
        return response()->json($salesOrder);
    }

    // Delete order
    public function destroy(SalesOrder $salesOrder)
    {
        // Only return stock if order was Completed

        if ($salesOrder->status === 'Completed') {
            foreach ($salesOrder->items as $item) {
                $this->adjustStock($item->inventory, $item->quantity, 'added', "Order #{$salesOrder->id} Deleted");
            }
        }


        $salesOrder->delete();
        return response()->json(['success' => 'Sales order deleted successfully.']);
    }

    // Show edit form
    public function edit(SalesOrder $order)
    {
        $order->load('items');

        return response()->json([
            'id' => $order->id,
            'client_id' => $order->client_id,
            'order_date' => $order->order_date,
            'status' => $order->status,
            'items' => $order->items->map(fn($item) => [
                'inventory_id' => $item->inventory_id,
                'quantity' => $item->quantity
            ]),
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:inventory_clients,id',
            'order_date' => 'required|date',
            'items' => 'required|string',
            'status' => 'required|in:Pending,Completed,Cancelled',
        ]);

        $items = json_decode($request->items, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid items format.'], 422);
        }

        DB::beginTransaction();
        try {
            $order = SalesOrder::with('items')->lockForUpdate()->findOrFail($id);

            $wasCompleted = $order->status === 'Completed';
            $wasCancelled = $order->status === 'Cancelled';
            $isCompleted = $request->status === 'Completed';
            $isCancelled = $request->status === 'Cancelled';

            $totalAmount = 0;

            // Process each new/updated item
            foreach ($items as $newItem) {
                $inventory = Inventory::lockForUpdate()->findOrFail($newItem['inventory_id']);
                $oldItem = $order->items->firstWhere('inventory_id', $newItem['inventory_id']);
                $oldQty = $oldItem ? $oldItem->quantity : 0;
                $newQty = $newItem['quantity'];

                if (!$wasCompleted && $isCompleted) {
                    // Pending → Completed
                    if ($inventory->Stock < $newQty) {
                        DB::rollBack();
                        return response()->json(['error' => "Not enough stock for {$inventory->Product}"], 422);
                    }
                    $this->adjustStock($inventory, -$newQty, 'sale', "Order #{$order->id} Completed");
                }

                if ($wasCompleted && $isCompleted) {
                    // Completed → Completed (quantity change)
                    $diff = $newQty - $oldQty;
                    if ($diff > 0 && $inventory->Stock < $diff) {
                        DB::rollBack();
                        return response()->json(['error' => "Not enough stock for {$inventory->Product}"], 422);
                    }
                    $this->adjustStock($inventory, -$diff, 'sale', "Order #{$order->id} Updated");
                }

                if ($wasCompleted && !$isCompleted) {
                    // Completed → Pending or Cancelled
                    $this->adjustStock($inventory, $oldQty, 'added', "Order #{$order->id} status changed to {$request->status}");
                }

                if ($wasCancelled && $isCompleted) {
                    // Cancelled → Completed
                    if ($inventory->Stock < $newQty) {
                        DB::rollBack();
                        return response()->json(['error' => "Not enough stock for {$inventory->Product}"], 422);
                    }
                    $this->adjustStock($inventory, -$newQty, 'sale', "Order #{$order->id} Completed");
                }


                // Update/create order items
                $totalPrice = $inventory->SalePrice * $newQty;

                if ($oldItem) {
                    $oldItem->update([
                        'quantity' => $newQty,
                        'unit_price' => $inventory->SalePrice,
                        'total_price' => $totalPrice,
                    ]);
                } else {
                    SalesOrderItem::create([
                        'sales_order_id' => $order->id,
                        'inventory_id' => $inventory->id,
                        'quantity' => $newQty,
                        'unit_price' => $inventory->SalePrice,
                        'total_price' => $totalPrice,
                    ]);
                }

                $totalAmount += $totalPrice;
            }

            // Handle removed items
            $oldItemIds = $order->items->pluck('inventory_id')->toArray();
            $newItemIds = array_column($items, 'inventory_id');
            $removedItems = array_diff($oldItemIds, $newItemIds);

            foreach ($removedItems as $invId) {
                $oldItem = $order->items->firstWhere('inventory_id', $invId);
                $inventory = Inventory::lockForUpdate()->findOrFail($invId);

                if ($wasCompleted) {
                    $inventory->Stock += $oldItem->quantity;
                    $inventory->save();
                }

                if ($wasCancelled) {
                    // Already cancelled → nothing to do
                }

                $oldItem->delete();
            }

            // Update order totals and status
            $order->update([
                'client_id' => $request->client_id,
                'order_date' => $request->order_date,
                'status' => $request->status,
                'total_amount' => $totalAmount,
            ]);

            DB::commit();
            return response()->json(['success' => 'Sales order updated successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    private function adjustStock(Inventory $inventory, int $qtyChange, string $type, string $remarks = null)
    {
        $previousStock = $inventory->Stock;
        $inventory->Stock += $qtyChange; // +ve to add, -ve to remove
        $inventory->save();

        DB::table('inventory_stock_history')->insert([
            'inventory_id' => $inventory->id,
            'change_type' => $type, // 'sale', 'added', etc.
            'quantity' => abs($qtyChange),
            'previous_stock' => $previousStock,
            'new_stock' => $inventory->Stock,
            'remarks' => $remarks,
            'created_at' => now(),
        ]);
    }
}
