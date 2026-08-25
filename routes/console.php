<?php

use App\Console\Commands\CheckDueSalesOrderCommand;
use App\Console\Commands\CheckLowStockCommand;
use App\Console\Commands\RemindAbandonedCartCommand;
use App\Console\Commands\WishlistPriceDropCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(CheckDueSalesOrderCommand::class)->everyMinute();
Schedule::command(WishlistPriceDropCommand::class)->daily();
Schedule::command(RemindAbandonedCartCommand::class)->dailyAt('09:00');
Schedule::command(CheckLowStockCommand::class)->dailyAt('08:00');
