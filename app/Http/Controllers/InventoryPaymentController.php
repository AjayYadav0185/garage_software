<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryPayment;
use App\Models\JobCard as InsuranceRo;
use App\Models\PaymentHistory;
use App\Models\InventoryStockHistory;
use DataTables;
use App\Models\SalesOrder;


class InventoryPaymentController extends Controller
{

    public function index()
    {
        // Get sales orders along with the client names (assuming 'inventory_clients' table is present)
        $salesOrders = SalesOrder::with('client:id,name')  // Assuming SalesOrder has a client relationship
            ->where('status', 'Completed')  // Filter for pending order
            // ->where('payment_status', 'pending')  // Filter for pending order
            ->select('id', 'order_date', 'total_amount', 'client_id')
            ->get();

        return view('payments.index', [
            'salesOrders' => $salesOrders,
        ]);
    }



    /**
     * Return payments data for DataTables AJAX
     */

    public function ajax()
    {
        // Eager load salesOrder and client information
        $data = InventoryPayment::with('salesOrder.client')
            ->orderBy('payment_date', 'desc')
            ->get();  // Don't forget to actually retrieve the data with ->get()

        $return = Datatables::of($data)
            ->addIndexColumn()  // Automatically adds an index column to your DataTables
            ->addColumn('order_info', function ($row) {
                $order = $row->salesOrder;
                // Safely access the client name, fallback to 'No client' if null
                $clientName = $order && $order->client ? $order->client->name : 'No client';
                return $order ? "Order #{$order->id} - {$clientName}" : 'N/A';
            })
            ->addColumn('actions', function ($row) {
                // Add an action button with a delete option
                return '<button class="btn btn-sm btn-danger delete-payment" data-id="' . $row->id . '">Delete</button>';
            })
            ->rawColumns(['actions'])  // Enable HTML rendering in actions column
            ->make(true);


        return $return;
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',  // Validate that the sales order exists
            'payment_date' => 'required|date',
            'payment_amount' => 'required|numeric|min:0.01',
            'payment_mode' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:500',
        ]);

        // Get the sales order by ID
        $order = SalesOrder::findOrFail($request->sales_order_id);

        // Validate the payment amount does not exceed the sales order total amount
        if ($request->payment_amount > $order->total_amount) {
            return response()->json(['error' => 'Payment amount cannot exceed the total order amount.'], 422);
        }

        // Create the payment
        $payment = InventoryPayment::create([
            'sales_order_id' => $request->sales_order_id,
            'payment_date' => $request->payment_date,
            'payment_amount' => $request->payment_amount,
            'payment_mode' => $request->payment_mode,
            'remarks' => $request->remarks,
        ]);

        // Update the payment status of the order based on the total payment amount
        $this->updatePaymentStatus($order, $payment->payment_amount);

        // Optionally log stock history (example)
        // $this->logStockHistory($order, $payment);

        // Return success response
        return response()->json(['success' => 'Payment recorded successfully.']);
    }



    /**
     * Delete a payment
     */
    public function destroy(InventoryPayment $payment)
    {
        $order = $payment->salesOrder;

        $payment->delete();

        if ($order) {
            $this->updatePaymentStatus($order);
        }

        return response()->json(['success' => 'Payment deleted successfully.']);
    }

    /**
     * Update the payment status of a sales order
     */
    private function updatePaymentStatus(SalesOrder $order)
    {
        $totalPaid = $order->payments()->sum('payment_amount');

        if (round($totalPaid, 2) >= round($order->total_amount, 2)) {
            $order->payment_status = 'paid';
        } elseif ($totalPaid > 0) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'pending';
        }

        $order->save();
    }

    /**
     * Optional: Log inventory stock history (example)
     * Call this if you want to track stock changes when a payment occurs
     */
    private function logStockHistory(SalesOrder $order, InventoryPayment $payment)
    {
        foreach ($order->items as $item) {
            $previousStock = $item->inventory->quantity;
            $newStock = $previousStock - $item->quantity;

            InventoryStockHistory::create([
                'inventory_id' => $item->inventory->id,
                'change_type' => 'sale',
                'quantity' => $item->quantity,
                'previous_stock' => $previousStock,
                'new_stock' => $newStock,
                'remarks' => "Payment #{$payment->id} recorded for Order #{$order->id}",
            ]);

            // Update actual inventory quantity
            $item->inventory->quantity = $newStock;
            $item->inventory->save();
        }
    }



    // Blade view
    public function Historyindex()
    {
        return view('payments.payment_history');
    }

    // AJAX DataTable data
    public function Historyajax(Request $request)
    {
        $query = PaymentHistory::with(['insuranceCompany', 'customer', 'jobcard']); // add relationships if needed

        $return =  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('jobcard', function ($row) {
                return $row->jobCard->invoice_no ?? 'N/A';
            })
            ->addColumn('client', function ($row) {
                // If inc_id exists, show insurance company as client, else customer
                if ($row->inc_id) {
                    return $row->insuranceCompany->insurence_company_name ?? 'N/A';
                }
                return $row->customer->cus_name ?? 'N/A';
            })
            ->addColumn('payment_date', function ($row) {
                return $row->created_at->format('d-m-Y');
            })
            ->addColumn('amount', function ($row) {
                return number_format($row->amount, 2);
            })
            ->addColumn('mode', function ($row) {
                return ucfirst($row->payment_type);
            })
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-danger btn-sm delete-payment" data-id="' . $row->id . '">Delete</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);

            
            return $return;

    }

    public function Historydestroy($id)
    {
        // Find the payment
        $payment = PaymentHistory::findOrFail($id);

        // Get related jobcard
        $jobcard = InsuranceRo::lockForUpdate()->findOrFail($payment->jobcard_id);

        // Delete the payment
        $payment->delete();

        // Recalculate total paid amount
        $totalPaid = PaymentHistory::where('jobcard_id', $jobcard->id)->sum('amount');

        // Calculate remaining due
        $remaining = max(0, $jobcard->totalPrice - $totalPaid);

        // Update jobcard status and dueamount
        $jobcard->update([
            'dueamount'      => $remaining,
            'payment_status' => $remaining == 0 ? 1 : 0,
            'status'         => $remaining == 0 ? 'C' : 'P',
        ]);

        return response()->json(['success' => 'Payment deleted successfully']);
    }
}
