<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Reminder extends Model
{
    protected $table = 'reminders';
    protected $fillable = ['name', 'email', 'reminder_type', 'service_date', 'is_sent'];

    public $timestamps = true;

    /**
     * Ensure the table exists (run at runtime if needed)
     */
    public static function ensureTableExists()
    {
        if (!Schema::hasTable('reminders')) {
            DB::statement("
                CREATE TABLE reminders (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    reminder_type VARCHAR(50) NOT NULL,
                    service_date DATE NULL,
                    is_sent TINYINT(1) DEFAULT 0,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ");
        }
    }

    /**
     * Get reminder counts grouped by type
     */
    public static function getCountsByType()
    {
        return DB::table('reminders')
            ->select('reminder_type', DB::raw('COUNT(*) as total'), DB::raw('SUM(is_sent = 1) as sent'), DB::raw('SUM(is_sent = 0) as pending'))
            ->groupBy('reminder_type')
            ->get();
    }
}
