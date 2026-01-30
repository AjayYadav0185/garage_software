<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;
use App\Models\UserManage;
use App\Models\Country;

class AuthAccount extends Authenticatable
{
    use HasFactory;

    protected $table = 'auth_accounts';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'type',        // admin | employee
        'ref_id',      // users.id | user_manages.id
        'email',
        'name',
        'login_type',
        'password',
        'country_id',
        'lang'
        ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* =====================================================
     |  Relationships
     ===================================================== */

    /**
     * Admin (User)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'ref_id', 'g_id');
    }

    /**
     * Employee (UserManage)
     */
    public function employee()
    {
        return $this->belongsTo(UserManage::class, 'ref_id', 'g_id');
    }

    /**
     * Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /* =====================================================
     |  Accessors
     ===================================================== */

    /**
     * Get language from country
     */
    public function getLanguageAttribute(): string
    {
        return $this->country->language ?? config('app.locale');
    }

    public function setLanguage(string $lang): void
    {
        $supported = config('languages'); // array of supported codes
        if (isset($supported[$lang])) {
            $this->update(['language' => $lang]);
            app()->setLocale($lang);
            session(['locale' => $lang]);
        }
    }

    /**
     * Get country code (ISO)
     */
    public function getCountryCodeAttribute(): ?string
    {
        return $this->country->code;
    }

    /* =====================================================
     |  Helpers
     ===================================================== */

    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function isEmployee(): bool
    {
        return $this->type === 'employee';
    }

    /* =====================================================
     |  Schema bootstrap (legacy-safe)
     ===================================================== */

    /**
     * Ensure auth_accounts table & columns exist
     * (kept for compatibility with your system)
     */
    public static function ensureTableExists(): void
    {
        if (!Schema::hasTable('auth_accounts')) {
            Schema::create('auth_accounts', function (Blueprint $table) {
                $table->id();
                $table->enum('type', ['admin', 'employee']);
                $table->unsignedBigInteger('ref_id');
                $table->string('name');
                $table->string('login_type');
                $table->string('email');
                $table->string('password');
                $table->unsignedBigInteger('country_id')->nullable();
                $table->timestamps();

                $table->index(['type', 'ref_id']);
                $table->index('country_id')->default(1);
                $table->string('lang', 10)->default('en');
            });
        } else {
            Schema::table('auth_accounts', function (Blueprint $table) {
                if (!Schema::hasColumn('auth_accounts', 'country_id')) {
                    $table->unsignedBigInteger('country_id')->nullable()->after('email');
                }
            });
        }
    }
}
