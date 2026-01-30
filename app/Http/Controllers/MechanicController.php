<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use App\Rules\PhoneNumber;

class MechanicController extends Controller
{
    public function index()
    {
        return view('mechanics.index');
    }

    public function ajaxList()
    {
        $mechanics = Mechanic::latest();

        return DataTables::of($mechanics)
            ->addColumn('actions', function ($row) {
                return '
                <button class="btn btn-sm btn-primary edit-mechanic" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-sm btn-danger delete-mechanic" data-id="' . $row->id . '">Delete</button>';
            })
            ->editColumn('status', function ($row) {
                // Convert status code to readable text
                return match ($row->status) {
                    1 => '<span class="badge badge-success">Acive</span>',
                    2 => '<span class="badge badge-warning">De-Active</span>',
                    default => '<span class="badge badge-secondary">Unknown</span>',
                };
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'm_name' => 'required|string|max:255',
            'm_mob' => ['required', new PhoneNumber(),'unique:all_mechanics,m_mob,NULL,id,g_id,' . auth_id()],
            'm_email' => 'nullable|email|max:50',
            'status' => 'nullable|in:1,2',
        ]);

        Mechanic::create([
            'g_id' => auth_id(),
            'm_name' => $request->m_name,
            'm_mob' => $request->m_mob,
            'm_email' => $request->m_email,
            'm_add' => $request->m_add,
            'password' => bcrypt($request->m_mob),
            'status' => $request->status ?? 1,
        ]);

        return response()->json(['success' => 'Mechanic added successfully']);
    }

    public function edit($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        return response()->json($mechanic);
    }

    public function update(Request $request, $id)
    {
        $mechanic = Mechanic::findOrFail($id);

        $request->validate([
            'm_name' => 'required|string|max:255',
            'm_mob' => ['required', new PhoneNumber()],
            'm_email' => 'nullable|email|max:50',
            // 'password' => 'nullable|string|min:6',
            'status' => 'nullable|in:1,2',
        ]);

        $data = $request->only(['m_name', 'm_mob', 'm_email', 'm_add', 'status']);
        if ($request->password) {
            $data['password'] = bcrypt($request->m_mob);
        }

        $mechanic->update($data);

        return response()->json(['success' => 'Mechanic updated successfully']);
    }

    public function destroy($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $mechanic->delete();

        return response()->json(['success' => 'Mechanic deleted successfully']);
    }
}
