<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\SpareExpense; // Make sure you have this model
use DataTables;
use Illuminate\Support\Facades\File;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InventoryImport;
use App\Exports\InventoryExport;

class InventoryController extends Controller
{
    private $uploadPath = 'uploads/inventory/';
    private $spareUploadPath = 'uploads/spare_expenses/';

    // ================= INVENTORY INDEX =================
    public function index()
    {
        return view('inventory.index'); // inventory and spare expenses can share the view or separate
    }

    // ================= INVENTORY DATA TABLE =================
    public function ajax(Request $request)
    {
        $data = Inventory::orderBy('ProductAdded', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('Photo', function ($row) {
                if ($row->Photo && $row->Photo !== 'N/A') {
                    return '<img src="' . asset($this->uploadPath . $row->Photo) . '" width="50" height="50">';
                }
                return 'N/A';
            })
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-sm btn-primary edit-inventory" data-id="' . $row->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger delete-inventory" data-id="' . $row->id . '">Delete</button>';
            })
            ->rawColumns(['actions', 'Photo'])
            ->make(true);
    }

    // ================= INVENTORY STORE (CREATE/UPDATE) =================

    public function store(Request $request)
    {
        $request->validate([
            'Product' => 'required|string|max:255',
            'PartNumber' => 'required|string|max:255',
            'HsnCode' => 'nullable|string|max:255',
            'Category' => 'required|string|max:255',
            'UnitType' => 'nullable|string|max:50',
            'Location' => 'nullable|string|max:255',
            'Stock' => 'required|integer|min:0',
            'MinStock' => 'nullable|integer|min:0',
            'CostPrice' => 'required|numeric',
            'SalePrice' => 'required|numeric',
            'cgst_percentage' => 'nullable|numeric',
            'sgst_percentage' => 'nullable|numeric',
            'igst_percentage' => 'nullable|numeric',
            'Photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except('Photo');

            // If ID is provided, update that record
            if ($request->filled('id')) {
                $inventory = Inventory::lockForUpdate()->find($request->id);
                if (!$inventory) {
                    return response()->json(['error' => 'Inventory not found'], 404);
                }

                $previousStock = $inventory->Stock;
                $newStock = $request->Stock;

                if ($request->hasFile('Photo')) {
                    $data['Photo'] = $this->uploadPhoto($request->Photo, $inventory->Photo);
                }

                $inventory->update($data);

                // Stock history
                if ($previousStock != $newStock) {
                    DB::table('inventory_stock_history')->insert([
                        'inventory_id' => $inventory->id,
                        'change_type' => $newStock > $previousStock ? 'added' : 'removed',
                        'quantity' => abs($newStock - $previousStock),
                        'previous_stock' => $previousStock,
                        'new_stock' => $newStock,
                        'remarks' => 'Stock updated manually',
                        'created_at' => now(),
                    ]);
                }

                $message = 'Inventory updated successfully.';
            } else {
                // No ID → insert new
                $lastPid = Inventory::max('pid') ?? 0;
                if ($request->hasFile('Photo')) {
                    $data['Photo'] = $this->uploadPhoto($request->Photo);
                } else {
                    $data['Photo'] = 'N/A';
                }

                $inventory = Inventory::create(array_merge($data, [
                    'pid' => $lastPid + 1,
                    'g_id' => auth_id(),
                    'ProductAdded' => now(),
                ]));

                DB::table('inventory_stock_history')->insert([
                    'inventory_id' => $inventory->id,
                    'change_type' => 'added',
                    'quantity' => $request->Stock,
                    'previous_stock' => 0,
                    'new_stock' => $request->Stock,
                    'remarks' => 'Initial stock added',
                    'created_at' => now(),
                ]);

                $message = 'Inventory added successfully.';
            }

            DB::commit();
            return response()->json(['success' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // ================= INVENTORY EDIT =================
    public function edit(Inventory $inventory)
    {
        return response()->json($inventory);
    }


    // ================= INVENTORY DELETE =================
    public function destroy(Inventory $inventory)
    {
        DB::beginTransaction();
        try {
            if ($inventory->Photo && $inventory->Photo !== 'N/A') {
                $path = public_path($this->uploadPath . $inventory->Photo);
                if (File::exists($path)) File::delete($path);
            }

            $inventory->delete();
            DB::commit();
            return response()->json(['success' => 'Inventory deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // ================= PHOTO UPLOAD =================
    private function uploadPhoto($file, $oldFile = null)
    {
        if ($oldFile && $oldFile !== 'N/A') {
            $oldPath = public_path($this->uploadPath . $oldFile);
            if (File::exists($oldPath)) File::delete($oldPath);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($this->uploadPath), $filename);
        return $filename;
    }

    // ================= INVENTORY EXPORT =================
    public function export()
    {
        return Excel::download(new InventoryExport, 'inventory.xlsx');
    }

    // ================= INVENTORY IMPORT =================
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        DB::beginTransaction();
        try {
            Excel::import(new InventoryImport, $request->file('file'));
            DB::commit();
            return response()->json(['success' => 'Inventory imported successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // ================= SPARE EXPENSES STORE =================
    public function spareStore(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required|string|max:50',
            'spare_date' => 'required|date',
            'spare_amount' => 'required|numeric',
            'spare_desc' => 'required|string',
            'spare_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'payment_status_spare' => 'nullable|string|max:255',
            'vendor_invoice_number' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'category' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except('spare_image');
            $data['g_id'] = auth_id();
            $data['created_at'] = now();

            if ($request->hasFile('spare_image')) {
                $filename = time() . '_' . $request->spare_image->getClientOriginalName();
                $request->spare_image->move(public_path($this->spareUploadPath), $filename);
                $data['spare_image'] = $filename;
            } else {
                $data['spare_image'] = 'N/A';
            }

            SpareExpense::create($data);

            DB::commit();
            return response()->json(['success' => 'Spare expense added successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // ================= SPARE EXPENSES DELETE =================
    public function spareDestroy(SpareExpense $spareExpense)
    {
        DB::beginTransaction();
        try {
            if ($spareExpense->spare_image && $spareExpense->spare_image !== 'N/A') {
                $path = public_path($this->spareUploadPath . $spareExpense->spare_image);
                if (File::exists($path)) File::delete($path);
            }

            $spareExpense->delete();
            DB::commit();
            return response()->json(['success' => 'Spare expense deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
