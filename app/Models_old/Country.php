<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_code',  // numeric dialing code
        'currency',
        'language',
        'timezone',
        'flag',
        'active',
    ];


    // Relation with CarMakers (multi-country support)
    public function carMakers()
    {
        return $this->belongsToMany(CarMaker::class, 'car_maker_country', 'country_id', 'car_maker_id');
    }
}
