<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
                        $table->id();
            $table->foreignId('farmer_device_id')->constrained('farmer_devices')->onDelete('cascade');
            $table->float('moisture_level')->nullable(); // 0-100%
            $table->float('temperature')->nullable();
            $table->float('water_flow')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
