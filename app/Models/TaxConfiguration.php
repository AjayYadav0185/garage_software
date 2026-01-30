<?php

// ============================================
// app/Models/TaxConfiguration.php
// ============================================

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'tax_system',
        'is_active',
        'tax_rules'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tax_rules' => 'array'
    ];

    /**
     * Get all tax rates for this configuration
     */
    public function taxRates()
    {
        return $this->hasMany(TaxRate::class);
    }

    /**
     * Get all inventories using this tax configuration
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get default tax rates
     */
    public function defaultRates()
    {
        return $this->taxRates()->where('is_default', true);
    }

    /**
     * Scope: Get only active configurations
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Get by country
     */
    public function scopeByCountry($query, $country)
    {
        return $query->where('country', $country);
    }
}

