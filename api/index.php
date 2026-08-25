<?php

declare(strict_types=1);

// Buat direktori storage sementara di /tmp agar Vercel (read-only filesystem) dapat berjalan lancar
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

// 1. Bersihkan seluruh environment variable yang bernilai string kosong ("") dari Vercel
foreach (array_merge($_ENV, $_SERVER) as $key => $value) {
    if ($value === '' || $value === 'null') {
        putenv($key);
        unset($_ENV[$key], $_SERVER[$key]);
    }
}

// 2. Set fallback default aman jika tidak diisi di Vercel
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

// Forward Vercel request ke Laravel entrypoint
require __DIR__.'/../public/index.php';
