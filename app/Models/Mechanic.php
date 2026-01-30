<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends BaseModel
{
    protected $table = 'all_mechanics';

    protected $fillable = [
        'g_id',
        'm_name',
        'm_mob',
        'm_email',
        'm_add',
        'password',
        'status',
    ];

    protected $hidden = ['password'];

    // Relationships
    // public function vehicles()
    // {
    //     return $this->hasMany(Vehicle::class, 'ci_id');
    // }
}
