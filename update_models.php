<?php

$models = ['Device', 'FarmerDevice', 'SensorData', 'Service', 'ServiceRequest'];

foreach ($models as $model) {
    $path = __DIR__ . "/app/Models/{$model}.php";
    $content = file_get_contents($path);
    $content = str_replace('use HasFactory;', "use HasFactory;\n    protected \$guarded = [];", $content);
    file_put_contents($path, $content);
}
echo "Models updated.\n";
