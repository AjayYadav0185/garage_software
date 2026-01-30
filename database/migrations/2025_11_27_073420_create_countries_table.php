<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Country Name
            $table->string('country_code', 5)->nullable(); // Dialing code e.g., 971, 91
            $table->string('currency', 10)->nullable();
            $table->string('language', 10)->nullable();
            $table->string('timezone', 50)->nullable();
            $table->string('flag')->nullable(); // Emoji or image
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
