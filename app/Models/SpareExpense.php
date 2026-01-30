<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpareExpense extends BaseModel
{
    use HasFactory;

    protected $table = 'spare_expenses';

    public $timestamps = false; // disable automatic timestamps
    
    protected $fillable = [
        'g_id',
        'vendor_name',
        'spare_date',
        'spare_amount',
        'spare_desc',
        'spare_image',
        'payment_status_spare',
        'vendor_invoice_number',
        'created_at',
        // NEW FIELDS
        'payment_method',   // Cash / Bank / Credit
        'category',         // e.g., Spare Parts, Consumables
    ];

    protected $casts = [
        'spare_date' => 'date',
        'spare_amount' => 'decimal:2',
    ];
}
