<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscExpense extends BaseModel
{
    use HasFactory;

    protected $table = 'misc_expenses';

    public $timestamps = false; // disable automatic timestamps
    
    protected $fillable = [
        'g_id',
        'misc_date',
        'misc_amount',
        'misc_desc',
        'misc_image',
        'payment_status_spare',
        'created_at',
        // NEW FIELDS
        'payment_method',       // Cash / Bank / Credit
        'reference_no',         // Optional reference or invoice number
        'category',             // e.g., Utilities, Rent, Misc
    ];

    protected $casts = [
        'misc_date' => 'date',
        'misc_amount' => 'decimal:2',
    ];
}
