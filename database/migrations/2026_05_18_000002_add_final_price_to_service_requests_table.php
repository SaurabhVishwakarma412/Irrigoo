<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->decimal('final_price', 10, 2)->nullable()->after('scheduled_date');
            $table->string('payment_status')->default('unpaid')->after('final_price');
        });
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['final_price', 'payment_status']);
        });
    }
};
