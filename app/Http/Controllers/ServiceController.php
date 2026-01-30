<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    // Show Blade view for servicesw
    public function index()
    {
        return view('services.index');
    }

    // DataTable AJAX for services
    public function ajax(Request $request)
    {
        $data = Service::orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-service" data-id="' . $row->id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-service" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Save service (create or update)
    public function store(Request $request)
    {
        $request->validate([
            'service_code' => 'required|string|max:255',
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric',
            'cgst_percentage' => 'nullable|numeric',
            'sgst_percentage' => 'nullable|numeric',
            'igst_percentage' => 'nullable|numeric',
            // 'service_duration' => 'required|integer',
            'service_description' => 'nullable|string',
            'service_status' => 'required|in:0,1',
        ]);

        $data = $request->all();

        if ($request->id) {
            // Update existing service
            $service = Service::findOrFail($request->id);
            $service->update($data);

            $message = 'Service updated successfully.';
        } else {
            // Create new service
            Service::create($data);
            $message = 'Service added successfully.';
        }

        return response()->json(['success' => $message]);
    }

    // Edit service
    public function edit(Service $service)
    {
        return response()->json($service);
    }

    // Delete service
    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json(['success' => 'Service deleted successfully.']);
    }
}
