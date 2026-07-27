<?php
declare(strict_types=1);

namespace App\Services;

use App\Data\SalesOrderData;
use App\Events\ShippingRecieptNumberUpdateEvent;
use App\Models\SalesOrder;

class SalesOrderService
{
    public function updateShippingReciept(SalesOrderData $sales_order, string $number) : SalesOrderData
    {
        $query = SalesOrder::query()->where('trx_id', $sales_order->trx_id)->first();

        $query->update([
            'shipping_reciept_number' => $number
        ]);

        $data = SalesOrderData::fromModel(
            $query->refresh()
        );

        event(new ShippingRecieptNumberUpdateEvent($data));

        return  $data;
    }
}
?>
