<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's singular form)
    protected $table = 'services';

    // Specify the primary key (optional if it's 'id')
    protected $primaryKey = 'id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'service_code',
        'service_name',
        'service_price',
        'cgst_percentage',
        'sgst_percentage',
        'igst_percentage',
        'service_duration',
        'service_description',
        'service_status',
    ];

    // Disable timestamps because you're manually handling `created_at` and `updated_at`
    public $timestamps = true;

    // If you want to use created_at and updated_at columns explicitly, uncomment below
    // protected $dates = ['created_at', 'updated_at'];
}
