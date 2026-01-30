<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;
use App\Rules\PhoneNumber;



class CustomerController extends Controller
{
    // Show Blade view
    public function index()
    {
        return view('customer.index');
    }

    // DataTable AJAX
    public function ajax(Request $request)
    {
        $data = Customer::latest();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-customer" data-id="' . $row->id . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-customer" data-id="' . $row->id . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Store new customer
    public function store(Request $request)
    {

        $request->validate([
            'cus_name' => 'required|string|max:100',
            'cus_mob' => ['required', new PhoneNumber(),'unique:customer,cus_mob,NULL,id,g_id,' . auth_id()],
            'cus_email' => 'nullable|email|max:100',
            'c_gst'    => 'nullable|string|max:100',
            'c_add'    => 'nullable|string|max:100',
        ]);

        
        // Get the latest c_id
        $lastCustomer = Customer::latest('c_id')->first();
        $new_c_id = $lastCustomer ? $lastCustomer->c_id + 1 : 1;

        $data = $request->all();
        $data['g_id'] = auth_id();
        $data['c_id'] = $new_c_id;      // Set the new c_id
        $data['created_at'] = now();     // Set created_at manually

        Customer::create($data);

        return response()->json(['success' => 'Customer added successfully.']);
    }


    // Edit customer
    public function edit(Customer $customer)
    {
        return response()->json($customer);
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'cus_name' => 'required|string|max:100',
            'cus_mob' => ['required', new PhoneNumber()],
            'cus_email' => 'nullable|email|max:100',
            'c_gst'    => 'nullable|string|max:100',
            'c_add'    => 'nullable|string|max:100',
        ]);

        $customer->update($request->all());

        return response()->json(['success' => 'Customer updated successfully.']);
    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['success' => 'Customer deleted successfully.']);
    }


    public function search(Request $request)
    {
        $search = $request->get('q', '');

        $customers = Customer::where('cus_name', 'like', "%{$search}%")
            ->orWhere('cus_mob', 'like', "%{$search}%")
            ->limit(20)
            ->get();

        $results = $customers->map(function ($c) {
            return [
                'id' => $c->c_id,
                'text' => $c->cus_name . ' (' . $c->cus_mob . ')',
                'name' => $c->cus_name,
                'contact' => $c->cus_mob,
                'email' => $c->cus_email,
                'gst' => $c->c_gst,
                'address' => $c->c_add,
            ];
        });

        return response()->json(['results' => $results]);
    }
}
