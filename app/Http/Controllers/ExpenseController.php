<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use App\Models\MiscExpense;
use App\Models\SalaryExpense;
use App\Models\UtilityExpense;
use App\Models\SpareExpense;
use App\Models\SubletExpense;
use App\Models\Vendor;
use DataTables;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index()
    {

        $mechanics = Mechanic::all();
        $vendors = Vendor::all();
        return view('expenses.manage', compact('vendors', 'mechanics'));
    }

    public function ajax(Request $request)
    {
        // Combine all expense types
        $misc = MiscExpense::selectRaw("'misc' as type, id, misc_date as date, misc_amount as amount, misc_desc as description, '' as vendor_name, misc_image as image, payment_status_spare as payment_status");
        $salary = SalaryExpense::selectRaw("'salary' as type, id, salary_date as date, salary_amount as amount, salary_desc as description, mechanic_name as vendor_name, salary_image as image, payment_status_spare as payment_status");
        $spare = SpareExpense::selectRaw("'spare' as type, id, spare_date as date, spare_amount as amount, spare_desc as description, vendor_name, spare_image as image, payment_status_spare as payment_status");
        $sublet = SubletExpense::selectRaw("'sublet' as type, id, sublet_date as date, sublet_amount as amount, sublet_desc as description, sublet_vendor as vendor_name, sublet_image as image, payment_status_spare as payment_status");
        $utility = UtilityExpense::selectRaw("'utility' as type, id, utility_date as date, utility_amount as amount, utility_desc as description, '' as vendor_name, utility_image as image, payment_status_spare as payment_status");

        $all = $misc->unionAll($salary)->unionAll($spare)->unionAll($sublet)->unionAll($utility);

        if ($request->type) {
            $all = $all->where('type', $request->type);
        }

        return Datatables::of($all)
            ->addIndexColumn()
            ->addColumn('vendor_mechanic', function ($row) {
                return $row->vendor_name ?? '';
            })
            ->addColumn('actions', function ($row) {
                $btn = '<button class="btn btn-sm btn-primary edit-expense" data-id="' . $row->id . '" data-type="' . $row->type . '">Edit</button> ';
                $btn .= '<button class="btn btn-sm btn-danger delete-expense" data-id="' . $row->id . '" data-type="' . $row->type . '">Delete</button>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function store(Request $request)
    {
        $type = $request->type;

        // Dynamic validation rules
        $rules = ['type' => 'required|in:misc,salary,spare,sublet,utility'];

        switch ($type) {
            case 'misc':
                $rules = array_merge($rules, [
                    'misc_date.*' => 'required|date',
                    'misc_amount.*' => 'required|numeric',
                    'misc_desc.*' => 'required|string',
                    'misc_images.*' => 'nullable|image|max:2048',
                    'misc_payment_type.*' => 'nullable|in:Due,Paid',
                    'misc_id.*' => 'nullable|integer|exists:misc_expenses,id', // for update
                ]);
                break;

            case 'salary':
                $rules = array_merge($rules, [
                    'salary_date.*' => 'required|date',
                    'salary_amount.*' => 'required|numeric',
                    'salary_desc.*' => 'required|string',
                    'salary_images.*' => 'nullable|image|max:2048',
                    'salary_payment_type.*' => 'nullable|in:Due,Paid',
                    'mechanic_name.*' => 'required|string|max:100',
                    'salary_id.*' => 'nullable|integer|exists:salary_expenses,id',
                ]);
                break;

            case 'spare':
                $rules = array_merge($rules, [
                    'spare_date.*' => 'required|date',
                    'spare_amount.*' => 'required|numeric',
                    'spare_desc.*' => 'required|string',
                    'spare_images.*' => 'nullable|image|max:2048',
                    'spare_payment_type.*' => 'nullable|in:Due,Paid',
                    'vendor_name.*' => 'required|string|max:100',
                    'vendor_invoice_number.*' => 'nullable|string|max:255',
                    'spare_id.*' => 'nullable|integer|exists:spare_expenses,id',
                ]);
                break;

            case 'sublet':
                $rules = array_merge($rules, [
                    'sublet_date.*' => 'required|date',
                    'sublet_amount.*' => 'required|numeric',
                    'sublet_desc.*' => 'required|string',
                    'sublet_images.*' => 'nullable|image|max:2048',
                    'sublet_payment_type.*' => 'nullable|in:Due,Paid',
                    'sublet_vendor.*' => 'required|string|max:100',
                    'sublet_id.*' => 'nullable|integer|exists:sublet_expenses,id',
                ]);
                break;

            case 'utility':
                $rules = array_merge($rules, [
                    'utility_date.*' => 'required|date',
                    'utility_amount.*' => 'required|numeric',
                    'utility_desc.*' => 'required|string',
                    'utility_images.*' => 'nullable|image|max:2048',
                    'utility_payment_type.*' => 'nullable|in:Due,Paid',
                    'utility_type.*' => 'required|string|max:50',
                    'utility_id.*' => 'nullable|integer|exists:utility_expenses,id',
                ]);
                break;
        }

        $request->validate($rules);

        $userId = auth_id() ?? 1; // fallback user ID
        $count = 0;

        // Loop through all entries
        $entries = $request->{$type . '_date'} ?? [];

        foreach ($entries as $index => $date) {

            // Check if ID exists -> update, else create
            $idField = $type . '_id';
            // $id = $request->{$idField}[$index] ?? null;
            $id = $request->id ?? null;

            $model = match ($type) {
                'misc' => MiscExpense::class,
                'salary' => SalaryExpense::class,
                'spare' => SpareExpense::class,
                'sublet' => SubletExpense::class,
                'utility' => UtilityExpense::class,
            };

            if ($id) {
                // Update existing record
                $expense = $model::findOrFail($id);
            } else {
                // Create new record
                $expense = new $model;
                $expense->g_id = $userId;
            }

            // Handle image
            $imageField = $type . '_images';
            if ($request->hasFile("$imageField.$index")) {
                // Delete old image if exists
                if (!empty($expense->{$type . '_image'})) {
                    Storage::disk('public')->delete($expense->{$type . '_image'});
                }
                $expense->{$type . '_image'} = $request->file("$imageField.$index")->store('expenses', 'public');
            }

            // Common fields
            $expense->{$type . '_date'} = $date;
            $expense->{$type . '_amount'} = $request->{$type . '_amount'}[$index];
            $expense->{$type . '_desc'} = $request->{$type . '_desc'}[$index];
            $expense->payment_status_spare = $request->{$type . '_payment_type'}[$index] ?? 'Due';

            // Vendor/mechanic/sublet/utility specific
            if ($type === 'salary') {
                $expense->mechanic_name = $request->mechanic_name[$index];
            } elseif ($type === 'spare') {
                $expense->vendor_name = $request->vendor_name[$index];
                $expense->vendor_invoice_number = $request->invoice_number[$index] ?? '';
            } elseif ($type === 'sublet') {
                $expense->sublet_vendor = $request->sublet_vendor[$index];
            } elseif ($type === 'utility') {
                $expense->utility_type = $request->utility_type[$index];
            }

            $expense->save();
            $count++;
        }

        return response()->json([
            'success' => "$count expense(s) saved successfully"
        ]);
    }


    public function edit(Request $request, $id)
    {

        $type = $request->query('type');

        switch ($type) {
            case 'misc':
                $expense = MiscExpense::findOrFail($id);
                break;
            case 'salary':
                $expense = SalaryExpense::findOrFail($id);
                break;
            case 'spare':
                $expense = SpareExpense::findOrFail($id);
                break;
            case 'sublet':
                $expense = SubletExpense::findOrFail($id);
                break;
            case 'utility':
                $expense = UtilityExpense::findOrFail($id);
                break;
            default:
                return response()->json(['error' => 'Invalid expense type'], 400);
        }


        $dateValue = $expense->{$type . '_date'};

        // If it's a Carbon/DateTime instance, format it
        if ($dateValue instanceof \DateTimeInterface) {
            $formattedDate = $dateValue->format('Y-m-d');
        }
        // If it's already a string, assume it's formatted
        elseif (is_string($dateValue)) {
            $formattedDate = $dateValue;
        }
        // Otherwise, null
        else {
            $formattedDate = null;
        }

        $formattedDate;


        $res = [
            'type' => $type,
            'utility_type' => $expense->utility_type ?? '',
            'id' => $expense->id,
            'date' => $formattedDate,
            // 'date' => $expense->{$type . '_date'}->format('Y-m-d'),
            'amount' => $expense->{$type . '_amount'},
            'description' => $expense->{$type . '_desc'},
            'vendor_name' => $expense->vendor_name ?? $expense->mechanic_name ?? $expense->sublet_vendor ?? '',
            'payment_status_spare' => $expense->payment_status_spare,
            'invoice_number' => $expense->vendor_invoice_number ?? '',
            'image' => $expense->{$type . '_image'} ?? ''
        ];



        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        // Validate including 'utility'
        $request->validate([
            'type' => 'required|in:misc,salary,spare,sublet,utility',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'vendor_name' => 'nullable|string|max:100',
            'payment_status' => 'nullable|in:Due,Paid',
            'invoice_number' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $type = $request->type;

        // Get the model dynamically
        $expense = match ($type) {
            'misc' => MiscExpense::findOrFail($id),
            'salary' => SalaryExpense::findOrFail($id),
            'spare' => SpareExpense::findOrFail($id),
            'sublet' => SubletExpense::findOrFail($id),
            'utility' => UtilityExpense::findOrFail($id),
            default => abort(404)
        };

        // Handle image upload
        if ($request->hasFile('image')) {
            if (!empty($expense->{$type . '_image'})) {
                Storage::disk('public')->delete($expense->{$type . '_image'});
            }
            $imagePath = $request->file('image')->store('expenses', 'public');
        } else {
            $imagePath = $expense->{$type . '_image'} ?? null;
        }

        // Update fields dynamically
        $expense->update([
            $type . '_date' => $request->date,
            $type . '_amount' => $request->amount,
            $type . '_desc' => $request->description,
            $type . '_image' => $imagePath,
            'vendor_name' => $request->vendor_name ?? $expense->vendor_name,
            'mechanic_name' => $request->vendor_name ?? $expense->mechanic_name,
            'sublet_vendor' => $request->vendor_name ?? $expense->sublet_vendor,
            'payment_status_spare' => $request->payment_status ?? $expense->payment_status_spare ?? 'Due',
            'vendor_invoice_number' => $request->invoice_number ?? $expense->vendor_invoice_number
        ]);

        return response()->json(['success' => 'Expense updated successfully']);
    }


    public function destroy(Request $request, $id)
    {
        $type = $request->query('type');
        $expense = match ($type) {
            'misc' => MiscExpense::findOrFail($id),
            'salary' => SalaryExpense::findOrFail($id),
            'spare' => SpareExpense::findOrFail($id),
            'sublet' => SubletExpense::findOrFail($id),
            'utility' => UtilityExpense::findOrFail($id),
            default => abort(404)
        };

        $expense->delete();
        return response()->json(['success' => 'Expense deleted successfully']);
    }
}
