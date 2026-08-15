<?php

namespace App\Notifications;

use App\Models\SalesOrder;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSalesOrderNotification extends Notification
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
            ->title('Pesanan Baru #'.$this->salesOrder->trx_id)
            ->body("Pesanan baru dari {$this->salesOrder->customer_full_name} dengan total ".number_format($this->salesOrder->total, 0, ',', '.'))
            ->icon('heroicon-o-shopping-bag')
            ->iconColor('success')
            ->actions([
                Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.back.resources.sales-orders.index')),
            ])
            ->getDatabaseMessage();
    }
}
