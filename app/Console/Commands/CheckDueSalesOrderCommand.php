<?php

namespace App\Console\Commands;

use App\Models\SalesOrder;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Pending;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CheckDueSalesOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sales-order:check-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Sales Order Due Date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->startOfMinute();

        SalesOrder::where('due_date_at', '<=', $now)
            ->where('status', Pending::class)
            ->get()
            ->each(function (SalesOrder $sales_order) use ($now) {
                DB::transaction(function () use ($sales_order, $now) {
                    // Kunci baris agar tidak terjadi balapan dengan webhook pembayaran.
                    $locked = SalesOrder::whereKey($sales_order->getKey())
                        ->lockForUpdate()
                        ->first();

                    if (! $locked) {
                        return;
                    }

                    if (! ($locked->status instanceof Pending) || $locked->due_date_at > $now) {
                        return;
                    }

                    $this->info("Due Date Found : #{$locked->trx_id}");

                    $locked->status->transitionTo(Cancel::class);
                });
            });
    }
}
