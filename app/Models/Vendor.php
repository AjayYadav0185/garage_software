<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends BaseModel
{
    use HasFactory;

    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    public $timestamps = false; // we will handle created_at manually if needed

    protected $fillable = [
        'g_id',
        'vender_name',
        'contact_info',
        'vendor_image',
        'description',
        'add_vendor_date',
        'vendor_gst_number',
        'created_at'
    ];
}
