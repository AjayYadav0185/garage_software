<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends BaseModel
{
    use HasFactory;

    // Table name (optional if it matches plural form, but added for clarity)
    protected $table = 'inventory';

    // Fillable columns for mass assignment
    protected $fillable = [
        'g_id',
        'pid',
        'Product',
        'Photo',
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
        'sgst_percentage',
        'igst_percentage',
        'ProductAdded',
        'tax_configuration_id',
        'tax_rate_id'
    ];

    // Enable timestamps if you want Laravel to manage created_at & updated_at
    // If you want to manage manually, keep this as false
    public $timestamps = true;

    // Optional: cast numeric fields for convenience
    protected $casts = [
        'Stock' => 'integer',
        'MinStock' => 'integer',
        // 'CostPrice' => 'decimal:2',
        'SalePrice' => 'integer',
        'cgst_percentage' => 'decimal:2',
        'sgst_percentage' => 'decimal:2',
        'igst_percentage' => 'decimal:2',
        'ProductAdded' => 'datetime',
    ];


    /**
     * Get the tax configuration for this inventory
     */
    public function taxConfiguration()
    {
        return $this->belongsTo(TaxConfiguration::class);
    }

    /**
     * Get the specific tax rate applied
     */
    public function taxRate()
    {
        return $this->belongsTo(TaxRate::class);
    }


    /**
     * Calculate tax amount
     */
    public function getTaxAmountAttribute()
    {
        if ($this->taxRate) {
            return $this->taxRate->calculateTax($this->SalePrice);
        }
        return 0;
    }

    /**
     * Get price including tax
     */
    public function getPriceWithTaxAttribute()
    {
        return $this->SalePrice + $this->tax_amount;
    }

    /**
     * Scope: Low stock items
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('Stock', '<=', 'MinStock');
    }
}
