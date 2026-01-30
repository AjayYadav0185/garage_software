<?php

namespace App\Services;

use App\Models\TaxConfiguration;

class TaxCalculator
{
    public static function calculateTax($amount, $taxRateId)
    {
        $taxRate = \App\Models\TaxRate::find($taxRateId);
        
        if (!$taxRate) {
            return 0;
        }

        return ($amount * $taxRate->rate_percentage) / 100;
    }

    public static function getTaxBreakdown($amount, $country, $isInterState = false)
    {
        $config = TaxConfiguration::where('country', $country)
            ->where('is_active', true)
            ->with('taxRates')
            ->first();

        if (!$config) {
            return [];
        }

        $breakdown = [];

        if ($config->tax_system === 'VAT') {
            $defaultRate = $config->taxRates()->where('is_default', true)->first();
            $breakdown['VAT'] = self::calculateTax($amount, $defaultRate->id);
        } 
        elseif ($config->tax_system === 'GST') {
            if ($isInterState) {
                // Use IGST for inter-state
                $igstRate = $config->taxRates()
                    ->where('tax_type', 'IGST')
                    ->where('is_default', true)
                    ->first();
                $breakdown['IGST'] = self::calculateTax($amount, $igstRate->id);
            } else {
                // Use CGST + SGST for intra-state
                $cgstRate = $config->taxRates()
                    ->where('tax_type', 'CGST')
                    ->where('is_default', true)
                    ->first();
                $sgstRate = $config->taxRates()
                    ->where('tax_type', 'SGST')
                    ->where('is_default', true)
                    ->first();
                
                $breakdown['CGST'] = self::calculateTax($amount, $cgstRate->id);
                $breakdown['SGST'] = self::calculateTax($amount, $sgstRate->id);
            }
        }

        return $breakdown;
    }
}