<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseModel extends Model
{
    protected static function booted()
    {
        // Global scope: automatically filter by g_id using auth_id() helper
        static::addGlobalScope('g_id', function (Builder $builder) {
            $currentId = auth_id(); // uses ref_id if exists, otherwise id
            if ($currentId) {
                $builder->where(
                    $builder->getModel()->getTable() . '.g_id',
                    $currentId
                );
            }
        });

        // Automatically assign g_id when creating
        static::creating(function ($model) {
            $currentId = auth_id();
            if ($currentId && empty($model->g_id)) {
                $model->g_id = $currentId;
            }
        });
    }
}
