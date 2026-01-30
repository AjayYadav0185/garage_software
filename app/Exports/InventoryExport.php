<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Inventory::select(
            'pid',
            'Product',
            'PartNumber',
            'HsnCode',
            'Category',
            'UnitType',
            'Location',
            'Stock',
            'MinStock',
            'CostPrice',
            'SalePrice',
            'cgst_percentage',
            // 'sgst_percentage',
            // 'igst_percentage'
        )->get();
    }

    public function headings(): array
    {
        return [
            'PID',
            'Product',
            'Part Number',
            'HSN Code',
            'Category',
            'Unit Type',
            'Location',
            'Stock',
            'Min Stock',
            'Cost Price',
            'Sale Price',
            'VAT %',
            // 'CGST %',
            // 'SGST %',
            // 'IGST %',
        ];
    }
}
