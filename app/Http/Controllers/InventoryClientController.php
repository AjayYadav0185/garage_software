<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryClient;
use DataTables;

class InventoryClientController extends Controller
{
    // Show Blade view
    public function index()
    {
        return view('inventory_clients.index');
    }

    // DataTable AJAX
    public function ajax(Request $request)
    {
        $data = InventoryClient::orderBy('created_at', 'desc');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-client" data-id="' . $row->id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-client" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Create or update client
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        if ($request->id) {
            $client = InventoryClient::findOrFail($request->id);
            $client->update($data);
            $message = 'Client updated successfully.';
        } else {
            $data['g_id'] = auth_id();
            InventoryClient::create($data);
            $message = 'Client added successfully.';
        }

        return response()->json(['success' => $message]);
    }

    // Edit client
    public function edit(InventoryClient $client)
    {
        return response()->json($client);
    }

    // Delete client
    public function destroy(InventoryClient $client)
    {
        $client->delete();
        return response()->json(['success' => 'Client deleted successfully.']);
    }
}
