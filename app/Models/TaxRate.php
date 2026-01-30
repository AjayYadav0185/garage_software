<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_configuration_id',
        'tax_type',
        'rate_name',
        'rate_percentage',
        'is_default'
    ];

    protected $casts = [
        'rate_percentage' => 'decimal:2',
        'is_default' => 'boolean'
    ];

    /**
     * Get the tax configuration that owns this rate
     */
    public function taxConfiguration()
    {
        return $this->belongsTo(TaxConfiguration::class);
    }

    /**
     * Calculate tax amount for a given price
     */
    public function calculateTax($amount)
    {
        return ($amount * $this->rate_percentage) / 100;
    }

    /**
     * Scope: Get default rates
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    /**
     * Scope: Get by tax type (VAT, CGST, SGST, IGST)
     */
    public function scopeByType($query, $type)
    {
        return $query->where('tax_type', $type);
    }
}