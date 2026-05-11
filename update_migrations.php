<?php

$migrations = [
    '2026_05_10_125958_create_devices_table.php' => <<<PHP
            \$table->id();
            \$table->foreignId('manufacturer_id')->constrained('users')->onDelete('cascade');
            \$table->string('name');
            \$table->text('description')->nullable();
            \$table->decimal('price', 8, 2)->nullable();
            \$table->json('features')->nullable();
            \$table->timestamps();
PHP,
    '2026_05_10_125958_create_farmer_devices_table.php' => <<<PHP
            \$table->id();
            \$table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            \$table->foreignId('device_id')->constrained('devices')->onDelete('cascade');
            \$table->string('status')->default('inactive'); // active, inactive
            \$table->boolean('irrigation_on')->default(false);
            \$table->date('installation_date')->nullable();
            \$table->timestamps();
PHP,
    '2026_05_10_125959_create_sensor_data_table.php' => <<<PHP
            \$table->id();
            \$table->foreignId('farmer_device_id')->constrained('farmer_devices')->onDelete('cascade');
            \$table->float('moisture_level')->nullable(); // 0-100%
            \$table->float('temperature')->nullable();
            \$table->float('water_flow')->nullable();
            \$table->timestamps();
PHP,
    '2026_05_10_125959_create_services_table.php' => <<<PHP
            \$table->id();
            \$table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            \$table->string('name');
            \$table->text('description')->nullable();
            \$table->string('type'); // installation, maintenance, repair
            \$table->decimal('base_price', 8, 2)->nullable();
            \$table->timestamps();
PHP,
    '2026_05_10_125959_create_service_requests_table.php' => <<<PHP
            \$table->id();
            \$table->foreignId('farmer_id')->constrained('users')->onDelete('cascade');
            \$table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            \$table->string('status')->default('pending'); // pending, accepted, completed, rejected
            \$table->dateTime('scheduled_date')->nullable();
            \$table->timestamps();
PHP,
];

foreach ($migrations as $file => $content) {
    $path = __DIR__ . '/database/migrations/' . $file;
    $fileContent = file_get_contents($path);
    $fileContent = preg_replace('/\$table->id\(\);\s+\$table->timestamps\(\);/', $content, $fileContent);
    file_put_contents($path, $fileContent);
}
echo "Migrations updated.\n";
