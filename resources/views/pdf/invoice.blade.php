<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->trx_id }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #20221b;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #555a42;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .store-name {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #20221b;
        }
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #555a42;
            text-align: right;
        }
        .meta-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .meta-card {
            background-color: #f7f7f2;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #e8e9e1;
        }
        .meta-label {
            font-size: 10px;
            color: #8c9082;
            text-transform: uppercase;
            font-weight: bold;
        }
        .meta-value {
            font-size: 12px;
            font-weight: bold;
            color: #20221b;
            margin-top: 2px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #555a42;
            color: #ffffff;
            text-align: left;
            padding: 8px 10px;
            font-size: 11px;
            text-transform: uppercase;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e8e9e1;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary-table {
            width: 50%;
            float: right;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .summary-table td {
            padding: 6px 10px;
        }
        .total-row td {
            border-top: 2px solid #555a42;
            font-size: 14px;
            font-weight: bold;
            color: #20221b;
        }
        .clear {
            clear: both;
        }
        .footer {
            border-top: 1px solid #e8e9e1;
            padding-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #8c9082;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td>
                <div class="store-name">{{ strtoupper(config('app.name')) }}</div>
                <div style="font-size: 10px; color: #8c9082;">E-Commerce Store & Lifestyle Collection</div>
            </td>
            <td class="text-right">
                <div class="invoice-title">FAKTUR / INVOICE</div>
                <div style="font-size: 11px; font-weight: bold;">#{{ $order->trx_id }}</div>
            </td>
        </tr>
    </table>

    <table class="meta-table">
        <tr>
            <td width="50%" style="vertical-align: top; padding-right: 10px;">
                <div class="meta-card">
                    <div class="meta-label">Tujuan Pengiriman</div>
                    <div class="meta-value">{{ $order->customer->full_name }}</div>
                    <div>{{ $order->customer->phone }}</div>
                    <div style="margin-top: 4px; color: #555a42;">{{ $order->address_line }}</div>
                </div>
            </td>
            <td width="50%" style="vertical-align: top; padding-left: 10px;">
                <div class="meta-card">
                    <div class="meta-label">Detail Transaksi</div>
                    <div><strong>Tanggal:</strong> {{ $order->created_at_formatted }}</div>
                    <div><strong>Status:</strong> {{ $order->status_label }}</div>
                    <div><strong>Metode Pembayaran:</strong> {{ $order->payment->label }}</div>
                    <div><strong>Ekspedisi:</strong> {{ strtoupper($order->shipping->courier ?? 'Reguler') }} @if(!empty($order->shipping->receipt_number)) (Resi: {{ $order->shipping->receipt_number }}) @endif</div>
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="45%">Produk</th>
                <th width="15%" class="text-center">SKU</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="12%" class="text-right">Harga</th>
                <th width="13%" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $item->name }}</strong></td>
                <td class="text-center">{{ $item->sku }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">{{ $item->price_formatted }}</td>
                <td class="text-right">{{ $item->total_formatted }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td>Subtotal Produk</td>
            <td class="text-right">{{ $order->sub_total_formatted }}</td>
        </tr>
        @if(!empty($order->coupon_code))
        <tr>
            <td>Diskon Kupon ({{ $order->coupon_code }})</td>
            <td class="text-right" style="color: #c53030;">- {{ $order->discount_total_formatted ?? 'Rp 0' }}</td>
        </tr>
        @endif
        <tr>
            <td>Ongkos Kirim</td>
            <td class="text-right">{{ $order->shipping_total_formatted }}</td>
        </tr>
        <tr class="total-row">
            <td>Grand Total</td>
            <td class="text-right">{{ $order->total_formatted }}</td>
        </tr>
    </table>

    <div class="clear"></div>

    <div class="footer">
        Terima kasih telah berbelanja di {{ config('app.name') }}! Jika Anda memiliki pertanyaan terkait invoice ini, silakan hubungi layanan pelanggan kami.
    </div>

</body>
</html>
