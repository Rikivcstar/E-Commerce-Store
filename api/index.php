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

// Redirect storage path & compiled view path ke /tmp
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

putenv('VERCEL=true');
$_ENV['VERCEL'] = 'true';
$_SERVER['VERCEL'] = 'true';

putenv('BROADCAST_CONNECTION=null');
$_ENV['BROADCAST_CONNECTION'] = 'null';
$_SERVER['BROADCAST_CONNECTION'] = 'null';

// Forward Vercel request ke Laravel entrypoint
require __DIR__.'/../public/index.php';
