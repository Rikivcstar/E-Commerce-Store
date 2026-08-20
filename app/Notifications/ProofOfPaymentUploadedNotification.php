<?php

namespace App\Notifications;

use App\Models\SalesOrder;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProofOfPaymentUploadedNotification extends Notification
{
    use Queueable;

    public function __construct(public SalesOrder $salesOrder) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Bukti Transfer: #'.$this->salesOrder->trx_id)
            ->body("Pelanggan {$this->salesOrder->customer_full_name} mengunggah bukti pembayaran untuk order ".number_format($this->salesOrder->total, 0, ',', '.').'.')
            ->icon('heroicon-o-banknotes')
            ->iconColor('warning')
            ->actions([
                Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.back.resources.sales-orders.index')),
            ])
            ->getDatabaseMessage();
    }
}