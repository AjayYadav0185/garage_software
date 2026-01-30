<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityExpense extends BaseModel
{
    use HasFactory;

    protected $table = 'utility_expenses';

    public $timestamps = false; // disable auto timestamps

    protected $fillable = [
        'g_id',
        'utility_type',
        'utility_date',
        'utility_amount',
        'utility_desc',
        'utility_image',
        'payment_status_spare',
    ];
}
