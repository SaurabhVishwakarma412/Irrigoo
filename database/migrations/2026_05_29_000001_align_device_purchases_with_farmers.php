<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('device_purchases') && Schema::hasColumn('device_purchases', 'provider_id') && ! Schema::hasColumn('device_purchases', 'farmer_id')) {
            Schema::table('device_purchases', function (Blueprint $table) {
                $table->dropForeign(['provider_id']);
            });

            Schema::table('device_purchases', function (Blueprint $table) {
                $table->renameColumn('provider_id', 'farmer_id');
            });

            Schema::table('device_purchases', function (Blueprint $table) {
                $table->foreign('farmer_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('device_purchases') && ! Schema::hasColumn('device_purchases', 'payment_status')) {
            Schema::table('device_purchases', function (Blueprint $table) {
                $table->string('payment_status')->default('paid')->after('total_price');
            });
        }

        if (Schema::hasTable('service_requests') && ! Schema::hasColumn('service_requests', 'payment_status')) {
            Schema::table('service_requests', function (Blueprint $table) {
                $table->string('payment_status')->default('unpaid')->after('final_price');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('service_requests') && Schema::hasColumn('service_requests', 'payment_status')) {
            Schema::table('service_requests', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }

        if (Schema::hasTable('device_purchases') && Schema::hasColumn('device_purchases', 'payment_status')) {
            Schema::table('device_purchases', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }

        if (Schema::hasTable('device_purchases') && Schema::hasColumn('device_purchases', 'farmer_id') && ! Schema::hasColumn('device_purchases', 'provider_id')) {
            Schema::table('device_purchases', function (Blueprint $table) {
                $table->dropForeign(['farmer_id']);
            });

            Schema::table('device_purchases', function (Blueprint $table) {
                $table->renameColumn('farmer_id', 'provider_id');
            });

            Schema::table('device_purchases', function (Blueprint $table) {
                $table->foreign('provider_id')->references('id')->on('users')->cascadeOnDelete();
            });
        }
    }
};
