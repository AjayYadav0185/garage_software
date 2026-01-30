<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePackage extends BaseModel
{
    use HasFactory;

    protected $table = 'servicepackage';

    public $timestamps = false;

    protected $fillable = [
        'g_id',
        'pid',
        'items',
        'package',
        'packageprice',
        'discountprice',
        'package_desc',
        'hsncode',
        'stock',
        'cgst_percentage',
        'sgst_percentage',
        'igst_percentage',
        'created_package_date',
    ];

    // Accessor to decode the 'items' JSON field
    public function getItemsAttribute($value)
    {
        return json_decode($value, true);  // Decode JSON to an array
    }
}
