<?php

namespace App\Http\Controllers\Account;

use App\Data\SalesOrderData;
use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function __invoke(SalesOrder $order)
    {
        $user = auth()->user();

        abort_unless(
            $user !== null && (int) $order->user_id === (int) $user->id,
            403,
            'Anda tidak memiliki akses ke invoice pesanan ini.'
        );

        $orderData = SalesOrderData::fromModel($order);

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $orderData,
        ]);

        return $pdf->download("Invoice-{$order->trx_id}.pdf");
    }
}