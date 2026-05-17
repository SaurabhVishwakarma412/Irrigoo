<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('farm_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('location');
            $table->string('crop_type')->nullable();
            $table->decimal('farm_size', 8, 2)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('organization');
            $table->string('phone')->nullable();
            $table->string('location');
            $table->string('service_area')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('manufacturer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('organization');
            $table->string('phone')->nullable();
            $table->string('location');
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacturer_profiles');
        Schema::dropIfExists('provider_profiles');
        Schema::dropIfExists('farmer_profiles');
    }
};
