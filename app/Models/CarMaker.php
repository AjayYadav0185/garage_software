<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarMaker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id', 'checkin'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'maker_id');
    }
}
