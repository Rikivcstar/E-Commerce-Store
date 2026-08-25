<?php

namespace App\Notifications;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notification;

class LowStockAlertNotification extends Notification
{
    use Queueable;

    public function __construct(public Collection $products) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $list = $this->products->map(
            fn ($product) => "• {$product->name} (SKU: {$product->sku}) — sisa {$product->stock}"
        )->join("\n");

        return FilamentNotification::make()
            ->title('Peringatan: '.count($this->products).' Produk Stok Menipis')
            ->body("Segera restok produk berikut:\n{$list}")
            ->icon('heroicon-o-exclamation-triangle')
            ->iconColor('warning')
            ->actions([
                Action::make('view')
                    ->label('Lihat Produk')
                    ->url(route('filament.back.resources.products.index')),
            ])
            ->getDatabaseMessage();
    }
}
