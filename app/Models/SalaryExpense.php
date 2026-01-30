<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryExpense extends BaseModel
{
    use HasFactory;

    protected $table = 'salary_expenses';

    public $timestamps = false; // disable automatic timestamps
    
    protected $fillable = [
        'g_id',
        'salary_date',
        'mechanic_name',
        'salary_amount',
        'salary_desc',
        'salary_image',
        'payment_status_spare',
        'created_at',
        // NEW FIELDS
        'payment_method',       // Cash / Bank / Credit
        'reference_no',         // Optional reference
    ];

    protected $casts = [
        'salary_date' => 'date',
        'salary_amount' => 'decimal:2',
    ];
}
