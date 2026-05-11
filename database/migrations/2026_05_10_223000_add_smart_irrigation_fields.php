<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('role');
            $table->string('location')->nullable()->after('phone');
            $table->string('crop_type')->nullable()->after('location');
            $table->string('organization')->nullable()->after('crop_type');
            $table->text('address')->nullable()->after('organization');
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->string('connectivity')->nullable()->after('description');
            $table->string('power_source')->nullable()->after('connectivity');
            $table->string('coverage_area')->nullable()->after('power_source');
            $table->string('target_crops')->nullable()->after('coverage_area');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('service_area')->nullable()->after('type');
            $table->string('crop_types')->nullable()->after('service_area');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['service_area', 'crop_types']);
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn(['connectivity', 'power_source', 'coverage_area', 'target_crops']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'location', 'crop_type', 'organization', 'address']);
        });
    }
};
