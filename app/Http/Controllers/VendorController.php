<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Rules\PhoneNumber;

class VendorController extends Controller
{
    // Show Blade view
    public function index()
    {
        return view('vendor.index');
    }

    // DataTable AJAX
    public function ajax(Request $request)
    {
        $data = Vendor::query();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-vendor" data-id="' . $row->vendor_id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-vendor" data-id="' . $row->vendor_id . '">Delete</button>';
                return $btn;
            })
            ->editColumn('vendor_image', function ($row) {
                return $row->vendor_image 
                    // ? '<img src="' . asset('storage/' . $row->vendor_image) . '" width="50" height="50">' 
                    ? 'N/A'
                    : 'N/A';
            })
            ->rawColumns(['actions', 'vendor_image'])
            ->make(true);
    }

    // Store new vendor
    public function store(Request $request)
    {
        
        $request->validate([
            'vender_name' => 'required|string|max:255',
            'contact_info' => ['required', new PhoneNumber()],
            'vendor_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable|string',
            'vendor_gst_number' => 'nullable|string|max:255',
        ]);


        $data = $request->all();
        $data['g_id'] = auth_id();

        // Handle image upload
        if ($request->hasFile('vendor_image')) {
            $file = $request->file('vendor_image');
            $filename = Str::slug($request->vender_name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('vendors', $filename, 'public');
            $data['vendor_image'] = $path;
        }

        Vendor::create($data);

        return response()->json(['success' => 'Vendor added successfully.']);
    }

    // Get vendor data for edit
    public function edit(Vendor $vendor)
    {
        return response()->json($vendor);
    }

    // Update vendor
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vender_name' => 'required|string|max:255',
            'contact_info' => ['required', new PhoneNumber(), 'unique:vendor.contact_info'],
            'vendor_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable|string',
            'vendor_gst_number' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('vendor_image')) {
            // Delete old image
            if ($vendor->vendor_image && Storage::disk('public')->exists($vendor->vendor_image)) {
                Storage::disk('public')->delete($vendor->vendor_image);
            }

            $file = $request->file('vendor_image');
            $filename = Str::slug($request->vender_name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('vendors', $filename, 'public');
            $data['vendor_image'] = $path;
        }

        $vendor->update($data);

        return response()->json(['success' => 'Vendor updated successfully.']);
    }

    // Delete vendor
    public function destroy(Vendor $vendor)
    {
        // Delete image if exists
        if ($vendor->vendor_image && Storage::disk('public')->exists($vendor->vendor_image)) {
            Storage::disk('public')->delete($vendor->vendor_image);
        }

        $vendor->delete();

        return response()->json(['success' => 'Vendor deleted successfully.']);
    }
}
