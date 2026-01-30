<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = ['maker_id', 'name', 'year'];

    public function maker(): BelongsTo
    {
        return $this->belongsTo(CarMaker::class, 'maker_id');
    }
}
