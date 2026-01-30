<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubletExpense extends BaseModel
{
    use HasFactory;

    protected $table = 'sublet_expenses';

    public $timestamps = false; // disable automatic timestamps
    
    protected $fillable = [
        'g_id',
        'sublet_vendor',
        'sublet_date',
        'sublet_amount',
        'sublet_desc',
        'sublet_image',
        'payment_status_spare',
        'created_at',
        // NEW FIELDS
        'payment_method',   // Cash / Bank / Credit
        'category',         // e.g., Workshop Sublet, Outsourcing
        'reference_no',     // Optional reference
    ];

    protected $casts = [
        'sublet_date' => 'date',
        'sublet_amount' => 'decimal:2',
    ];
}
