<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class UserManage extends Authenticatable
{

    use HasFactory, HasRoles;

    protected $table = 'user_manage';
    public $timestamps = false;

    protected $fillable = [
        'g_id',
        'user_code',
        'name',
        'user_image',
        'email',
        'user_phone',
        'password',
        'gender',
        'role_id',
        'status'
    ];

    protected $guard_name = 'web'; // Spatie guard
    protected $hidden = ['password'];

    // Role relationship
    public function role()
    {
        return $this->belongsTo(\Spatie\Permission\Models\Role::class, 'role_id');
    }

    /**
     * Ensure the table exists, create if not.
     */
    public static function ensureTableExists()
    {
        if (!Schema::hasTable('user_manage')) {
            Schema::create('user_manage', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('g_id')->unique();
                $table->integer('user_code')->nullable();
                $table->string('name', 100);
                $table->string('user_image')->nullable();
                $table->string('email', 100)->unique();
                $table->bigInteger('user_phone')->nullable();
                $table->string('password');
                $table->string('gender')->nullable();
                $table->integer('role_id');
                $table->enum('status', ['Active', 'Inactive'])->default('Active');
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    // Mutator to hash password automatically
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'g_id', 'g_id');
    }
    
    public function scopeByGroup($query)
    {
        if (auth()->check()) {
            $query->where('g_id', auth_id());
        }
        return $query;
    }
}
