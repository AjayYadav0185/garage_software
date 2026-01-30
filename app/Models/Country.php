<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'currency',
        'language',
        'status',
    ];


    /**
     * Booted: apply global scope
     */
    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 'Active');
        });
    }

    // Relation with CarMakers (multi-country support)
    public function carMakers()
    {
        return $this->belongsToMany(CarMaker::class, 'car_maker_country', 'country_id', 'car_maker_id');
    }
}
