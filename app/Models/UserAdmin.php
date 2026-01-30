<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class UserAdmin extends Authenticatable
{
    use Notifiable, HasRoles;

    // Use the existing users table
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guard_name = 'admin'; // Spatie permissions guard

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Filament admin panel display name
    public function getFilamentName(): string
    {
        return $this->name ?? $this->email ?? 'Admin';
    }

    // Filament login email
    public function getFilamentEmail(): string
    {
        return $this->email;
    }
}
