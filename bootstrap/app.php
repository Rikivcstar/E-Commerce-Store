<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Clean up any empty string env vars from Vercel before Application configure
foreach (array_merge($_ENV, $_SERVER) as $key => $value) {
    if ($value === '') {
        putenv($key);
        unset($_ENV[$key], $_SERVER[$key]);
    }
}

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
            except: ['moota/callback', 'xendit/callback']
        );
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \RealRashid\SweetAlert\ToSweetAlert::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

if (isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']) || env('VERCEL') || env('VIEW_COMPILED_PATH')) {
    $storagePath = '/tmp/storage';
    foreach ([
        $storagePath.'/app/public',
        $storagePath.'/framework/views',
        $storagePath.'/framework/cache/data',
        $storagePath.'/framework/sessions',
        $storagePath.'/logs',
    ] as $dir) {
        if (! is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
    }
    $app->useStoragePath($storagePath);
}

return $app;
