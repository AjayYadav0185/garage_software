<?php

namespace App\Http\Controllers;

use App\Models\InsuranceCompany as InsurenceDetail;
use Illuminate\Http\Request;
use DataTables;
use App\Rules\PhoneNumber;

class InsurenceDetailController extends Controller
{
    public function index()
    {
        return view('insurence.index');
    }

    // DATATABLE AJAX
    public function ajax(Request $request)
    {
        $query = InsurenceDetail::where('g_id', auth_id())->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-sm btn-warning edit-insurence" data-id="'.$row->id.'">Edit</button>
                    <button class="btn btn-sm btn-danger delete-insurence" data-id="'.$row->id.'">Delete</button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'insurence_company_name' => 'required|string|max:255',
            'insurence_company_number' => ['required', new PhoneNumber(),'unique:insurence_details,insurence_company_number,NULL,id,g_id,' . auth_id()],
            'insurence_email_address' => 'nullable|email',
            'insurence_tax_number' => 'nullable|string|max:50',
        ]);

        InsurenceDetail::create($request->all() + [
            'g_id' => auth_id()
        ]);

        return response()->json(['success' => 'Insurance created successfully']);
    }

    // EDIT
    public function edit($id)
    {
        return InsurenceDetail::findOrFail($id);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'insurence_company_name' => 'required|string|max:255',
        ]);

        InsurenceDetail::findOrFail($id)->update($request->all());

        return response()->json(['success' => 'Insurance updated successfully']);
    }

    // DELETE
    public function destroy($id)
    {
        InsurenceDetail::findOrFail($id)->delete();
        return response()->json(['success' => 'Insurance deleted successfully']);
    }
}
