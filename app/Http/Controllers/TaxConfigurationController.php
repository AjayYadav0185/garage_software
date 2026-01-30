<?php

namespace App\Http\Controllers;

use App\Models\TaxConfiguration;
use App\Models\TaxRate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaxConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tax-configurations.index');
    }

    /**
     * Ajax DataTable
     */
    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = TaxConfiguration::with('taxRates')->latest();

            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    $editBtn = '<button class="btn btn-sm btn-primary edit-tax-config" data-id="' . $row->id . '">
                                    <i class="fas fa-edit"></i> ' . translate('Edit') . '
                                </button>';
                    
                    $deleteBtn = '<button class="btn btn-sm btn-danger delete-tax-config" data-id="' . $row->id . '">
                                    <i class="fas fa-trash"></i> ' . translate('Delete') . '
                                  </button>';

                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|string|unique:tax_configurations,country',
            'tax_system' => 'required|string',
            'is_active' => 'boolean',
            'rates' => 'required|array|min:1',
            'rates.*.tax_type' => 'required|string',
            'rates.*.rate_name' => 'required|string',
            'rates.*.rate_percentage' => 'required|numeric|min:0|max:100',
            'rates.*.is_default' => 'boolean',
        ]);

        try {
            // Create Tax Configuration
            $taxConfig = TaxConfiguration::create([
                'country' => $validated['country'],
                'tax_system' => $validated['tax_system'],
                'is_active' => $validated['is_active'] ?? 1,
            ]);

            // Create Tax Rates
            foreach ($validated['rates'] as $rate) {
                $taxConfig->taxRates()->create([
                    'tax_type' => $rate['tax_type'],
                    'rate_name' => $rate['rate_name'],
                    'rate_percentage' => $rate['rate_percentage'],
                    'is_default' => $rate['is_default'] ?? 0,
                ]);
            }

            return response()->json([
                'success' => translate('Tax configuration created successfully'),
                'data' => $taxConfig->load('taxRates')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => translate('Failed to create tax configuration'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $taxConfig = TaxConfiguration::with('taxRates')->findOrFail($id);
        return response()->json($taxConfig);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'country' => 'required|string|unique:tax_configurations,country,' . $id,
            'tax_system' => 'required|string',
            'is_active' => 'boolean',
            'rates' => 'required|array|min:1',
            'rates.*.tax_type' => 'required|string',
            'rates.*.rate_name' => 'required|string',
            'rates.*.rate_percentage' => 'required|numeric|min:0|max:100',
            'rates.*.is_default' => 'boolean',
        ]);

        try {
            $taxConfig = TaxConfiguration::findOrFail($id);

            // Update Tax Configuration
            $taxConfig->update([
                'country' => $validated['country'],
                'tax_system' => $validated['tax_system'],
                'is_active' => $validated['is_active'] ?? 1,
            ]);

            // Delete old rates and create new ones
            $taxConfig->taxRates()->delete();

            foreach ($validated['rates'] as $rate) {
                $taxConfig->taxRates()->create([
                    'tax_type' => $rate['tax_type'],
                    'rate_name' => $rate['rate_name'],
                    'rate_percentage' => $rate['rate_percentage'],
                    'is_default' => $rate['is_default'] ?? 0,
                ]);
            }

            return response()->json([
                'success' => translate('Tax configuration updated successfully'),
                'data' => $taxConfig->load('taxRates')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => translate('Failed to update tax configuration'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $taxConfig = TaxConfiguration::findOrFail($id);
            
            // Check if any inventory is using this configuration
            if ($taxConfig->inventories()->count() > 0) {
                return response()->json([
                    'message' => translate('Cannot delete! This tax configuration is being used by inventory items.')
                ], 422);
            }

            $taxConfig->delete();

            return response()->json([
                'success' => translate('Tax configuration deleted successfully')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => translate('Failed to delete tax configuration'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get tax rates for a specific country (for dropdowns)
     */
    public function getTaxRates($country)
    {
        $config = TaxConfiguration::where('country', $country)
            ->where('is_active', 1)
            ->with('taxRates')
            ->first();

        if (!$config) {
            return response()->json([
                'message' => translate('No active tax configuration found for this country')
            ], 404);
        }

        return response()->json($config);
    }

    /**
     * Get all active tax configurations (for inventory form dropdowns)
     */
    public function getActiveTaxConfigurations()
    {
        $configs = TaxConfiguration::where('is_active', 1)
            ->with('taxRates')
            ->get();

        return response()->json($configs);
    }
}