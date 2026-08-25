<?php

declare(strict_types=1);

define('LARAVEL_START', microtime(true));

// 1. Buat direktori storage sementara di /tmp untuk Vercel read-only filesystem
$storageDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// 2. Bersihkan environment variable bernilai string kosong ("") dari Vercel
foreach (array_merge($_ENV, $_SERVER) as $key => $value) {
    if ($value === '' || $value === 'null') {
        putenv($key);
        unset($_ENV[$key], $_SERVER[$key]);
    }
}

// 3. Set fallback default yang aman untuk Vercel
$defaults = [
    'VERCEL' => 'true',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'QUEUE_CONNECTION' => 'sync',
    'FILESYSTEM_DISK' => 'local',
    'BROADCAST_CONNECTION' => 'null',
    'LOG_CHANNEL' => 'stderr',
    'MAIL_MAILER' => 'array',
];

foreach ($defaults as $k => $v) {
    if (empty($_ENV[$k])) {
        putenv("{$k}={$v}");
        $_ENV[$k] = $v;
        $_SERVER[$k] = $v;
    }
}

// 4. Jalankan HTTP Kernel Laravel secara cepat tanpa overhead
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
