<?php

namespace App\Http\Controllers\Admin;

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
            $user && $user->hasAnyRole(['super_admin', 'panel_user']),
            403,
            'Anda tidak memiliki akses ke dokumen ini.'
        );

        $orderData = SalesOrderData::fromModel($order);

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $orderData,
        ]);

        return $pdf->download("Invoice-{$order->trx_id}.pdf");
    }
}
