<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use App\Notifications\CustomPasswordResetNotification;

class User extends Authenticatable
{
    use HasPermissions, HasApiTokens, Notifiable, HasRoles;

    // Custom table & PK
    protected $table = 'call_login';
    protected $primaryKey = 'g_id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';
    // protected $roleClass = Role::class; // explicitly define Role class

    protected $fillable = [
        'username',
        'g_name',
        'g_gst',
        'email',
        'g_email',
        'g_mob',
        'img',
        'qrcode',
        'stamp',
        'sign',
        'state',
        'city',
        'g_address',
        'country_id',
        'password',
        'remember_token',
        'created_at',
        'trial_end_date',
        'permission_status_user_man',
        'permission_status_gst',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'created_at' => 'datetime',
        'trial_end_date' => 'date',
        'permission_status_user_man' => 'boolean',
        'permission_status_gst' => 'boolean',
    ];

    protected $guard_name = 'web';

    // Filament
    public function getFilamentEmail(): string
    {
        return $this->email ?? $this->username;
    }

    public function getFilamentName(): string
    {
        return $this->username ?? 'User';
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordResetNotification($token));
    }

    public function getKeyName()
    {
        return $this->primaryKey; // ensures Spatie uses g_id
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
