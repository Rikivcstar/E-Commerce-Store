<?php

namespace App\Events;

use App\Data\SalesOrderData;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalesOrderProofUploadedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public SalesOrderData $sales_order
    ) {}
}