<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    use HasFactory;

    protected $table = 'customer';
    public $timestamps = false; // Disable created_at/updated_at auto handling

    protected $fillable = [
        'g_id',
        'c_id',
        'cus_name',
        'cus_mob',
        'cus_email',
        'c_gst',
        'c_add',
    ];
}
