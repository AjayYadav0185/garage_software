<?php

namespace App\Imports;

use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class InventoryImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {

                if (empty($row['product']) || empty($row['part_number'])) {
                    continue; // skip invalid rows
                }

                // Check existing inventory by Product + PartNumber
                $inventory = Inventory::where('Product', $row['product'])
                    ->where('PartNumber', $row['part_number'])
                    ->lockForUpdate()
                    ->first();

                if ($inventory) {
                    // ===== UPDATE EXISTING =====
                    $previousStock = $inventory->Stock;
                    $newStock = (int) $row['stock'];

                    $inventory->update([
                        'HsnCode' => $row['hsn_code'] ?? $inventory->HsnCode,
                        'Category' => $row['category'] ?? $inventory->Category,
                        'UnitType' => $row['unit_type'] ?? $inventory->UnitType,
                        'Location' => $row['location'] ?? $inventory->Location,
                        'Stock' => $newStock,
                        'MinStock' => $row['min_stock'] ?? $inventory->MinStock,
                        'CostPrice' => $row['cost_price'] ?? $inventory->CostPrice,
                        'SalePrice' => $row['sale_price'] ?? $inventory->SalePrice,
                        'cgst_percentage' => $row['cgst_percentage'] ?? $inventory->cgst_percentage,
                        'sgst_percentage' => $row['sgst_percentage'] ?? $inventory->sgst_percentage,
                        'igst_percentage' => $row['igst_percentage'] ?? $inventory->igst_percentage,
                    ]);

                    // ===== STOCK LOG =====
                    if ($previousStock != $newStock) {
                        DB::table('inventory_stock_history')->insert([
                            'inventory_id'   => $inventory->id,
                            'change_type'    => $newStock > $previousStock ? 'purchase' : 'removed',
                            'quantity'       => abs($newStock - $previousStock),
                            'previous_stock' => $previousStock,
                            'new_stock'      => $newStock,
                            'remarks'        => 'Stock updated via Excel import',
                            'created_at'     => now(),
                        ]);
                    }

                } else {
                    // ===== CREATE NEW =====
                    $inventory = Inventory::create([
                        'pid' => Inventory::max('pid') + 1,
                        'Product' => $row['product'],
                        'PartNumber' => $row['part_number'],
                        'HsnCode' => $row['hsn_code'] ?? null,
                        'Category' => $row['category'],
                        'UnitType' => $row['unit_type'] ?? null,
                        'Location' => $row['location'] ?? null,
                        'Stock' => (int) $row['stock'],
                        'MinStock' => $row['min_stock'] ?? 0,
                        'CostPrice' => $row['cost_price'],
                        'SalePrice' => $row['sale_price'],
                        'cgst_percentage' => $row['cgst_percentage'] ?? 0,
                        'sgst_percentage' => $row['sgst_percentage'] ?? 0,
                        'igst_percentage' => $row['igst_percentage'] ?? 0,
                        'Photo' => 'N/A',
                        'ProductAdded' => now(),
                        'g_id' => Auth::id(),
                    ]);

                    // ===== STOCK LOG =====
                    DB::table('inventory_stock_history')->insert([
                        'inventory_id'   => $inventory->id,
                        'change_type'    => 'added',
                        'quantity'       => (int) $row['stock'],
                        'previous_stock' => 0,
                        'new_stock'      => (int) $row['stock'],
                        'remarks'        => 'Initial stock via Excel import',
                        'created_at'     => now(),
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
