<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('carFuel', 255);
            $table->string('code', 10)->nullable(); // optional short code
            $table->text('description')->nullable();
            $table->boolean('status')->default(true); // active/inactive
            $table->string('icon')->nullable(); // optional image/icon
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_types');
    }
};
