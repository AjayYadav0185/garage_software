<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicePackage;
use DataTables;

class ServicePackageController extends Controller
{
    // Show Blade view
    public function index()
    {
        // Pass inventory for select2 in modal
        $inventory = \App\Models\Inventory::orderBy('Product')->get(['id', 'Product as part_name', 'Stock as stock']);
        return view('servicepackage.index', compact('inventory'));
    }

    // DataTable AJAX
    public function ajax(Request $request)
    {
        $data = ServicePackage::orderBy('created_package_date', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-package" data-id="' . $row->id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-package" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Store new service package
    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string|max:255',
            'packageprice' => 'required|numeric',
            'discountprice' => 'nullable|numeric',
            'package_desc' => 'nullable|string',
            'hsncode' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'cgst_percentage' => 'required|numeric|min:0',
            // 'sgst_percentage' => 'required|numeric|min:0',
            // 'igst_percentage' => 'required|numeric|min:0',
            'items' => 'nullable|array',
            'items.*' => 'integer|exists:inventory,id',
        ]);

        // Auto increment pid
        $lastPackage = ServicePackage::latest('pid')->first();
        $new_pid = $lastPackage ? $lastPackage->pid + 1 : 1;

        $data = $request->all();
        $data['g_id'] = auth_id();
        $data['pid'] = $new_pid;

        // Encode items as JSON
        // Transform items into array of objects with quantity
        if (isset($data['items'])) {
            $itemsWithQuantity = [];
            foreach ($data['items'] as $itemId) {
                $itemsWithQuantity[] = [
                    'id' => $itemId,
                    'quantity' => 1 // static quantity
                ];
            }
            $data['items'] = json_encode($itemsWithQuantity);
        } else {
            $data['items'] = null;
        }


        ServicePackage::create($data);


        return response()->json(['success' => 'Service Package added successfully.']);
    }

    // Edit service package
    public function edit(ServicePackage $servicePackage)
    {
        return response()->json([
            'success' => true,
            'data' => $servicePackage
        ]);
    }


    // Update service package
    public function update(Request $request, ServicePackage $servicePackage)
    {
        $request->validate([
            'package' => 'required|string|max:255',
            'packageprice' => 'required|numeric',
            'discountprice' => 'nullable|numeric',
            'package_desc' => 'nullable|string',
            'hsncode' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'cgst_percentage' => 'required|numeric|min:0',
            // 'sgst_percentage' => 'required|numeric|min:0',
            // 'igst_percentage' => 'required|numeric|min:0',
            'items' => 'nullable|array',
            'items.*' => 'integer|exists:inventory,id',
        ]);

        $data = $request->all();

        // Transform items into array of objects with quantity
        if (isset($data['items'])) {
            $itemsWithQuantity = [];
            foreach ($data['items'] as $itemId) {
                $itemsWithQuantity[] = [
                    'id' => $itemId,
                    'quantity' => 1 // static quantity
                ];
            }
            $data['items'] = ($itemsWithQuantity);
        } else {
            $data['items'] = null;
        }


        $servicePackage->update($data);

        return response()->json(['success' => 'Service Package updated successfully.']);
    }


    // Delete service package
    public function destroy(ServicePackage $servicePackage)
    {

        $servicePackage->delete();

        return response()->json(['success' => 'Service Package deleted successfully.']);
    }
}
