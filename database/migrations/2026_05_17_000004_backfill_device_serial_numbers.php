<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('devices')
            ->whereNull('serial_number')
            ->orderBy('id')
            ->get(['id'])
            ->each(function (object $device): void {
                DB::table('devices')
                    ->where('id', $device->id)
                    ->update(['serial_number' => 'DEV-'.Str::upper(Str::random(10))]);
            });
    }

    public function down(): void
    {
        // Existing serial numbers are intentionally retained on rollback.
    }
};
