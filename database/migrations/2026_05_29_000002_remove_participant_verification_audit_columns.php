<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'verified_by')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('verified_by');
            });
        }

        if (Schema::hasColumn('users', 'verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('verified_at');
            });
        }

    }

    public function down(): void
    {
        if (! Schema::hasColumn('users', 'verified_by')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('verified_by')->nullable()->after('is_verified')->constrained('users')->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('users', 'verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            });
        }
    }
};
