<?php

namespace App\Filament\Resources\SalesOrders\Pages;

use App\Data\SalesOrderData;
use App\Filament\Resources\SalesOrders\SalesOrderResource;
use App\Services\SalesOrderService;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesOrder extends ViewRecord
{
    protected static string $resource = SalesOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Konfirmasi Pembayaran')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => get_class($this->record->status) === Pending::class
                    && $this->record->payment_driver === 'offline')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi Pembayaran')
                ->modalDescription('Tandai pesanan ini sebagai sudah dibayar dan pindahkan statusnya menjadi sedang diproses?')
                ->action(function () {
                    $this->record->status->transitionTo(Progress::class);

                    Notification::make()
                        ->success()
                        ->title('Pembayaran dikonfirmasi')
                        ->body("Pesanan #{$this->record->trx_id} telah dipindahkan ke status sedang diproses.")
                        ->send();
                }),

            Action::make('Proses')
                ->icon('heroicon-o-arrow-path-rounded-square')
                ->modalWidth('sm')
                ->visible(fn () => in_array(get_class($this->record->status), [
                    Pending::class,
                    Progress::class,
                ]))
                ->form(function () {
                    $transition = $this->record->status->transitionableStates();
                    $options = collect($transition)->mapWithKeys(fn ($class) => [
                        $class => (new $class($this->record))->label(),
                    ])->toArray();

                    return [
                        Radio::make('status')
                            ->label('Status')
                            ->options($options)
                            ->required()
                            ->inline(),
                    ];
                })
                ->action(function (array $data) {
                    $this->record->status->transitionTo(data_get($data, 'status'));
                }),

            Action::make('Input Resi Pengiriman')
                ->icon('heroicon-o-truck')
                ->modalWidth('sm')
                ->modalHeading('Input Nomor Resi')
                ->visible(function () {
                    $status = get_class($this->record->status);

                    $valid_statuses = [
                        Progress::class,
                        Completed::class,
                    ];

                    return in_array($status, $valid_statuses) &&
                        empty($this->record->shipping_receipt_number);
                })
                ->form([
                    TextInput::make('shipping_receipt_number')
                        ->label('Nomor Receipt')
                        ->required(),
                ])->action(function (array $data) {
                    app(SalesOrderService::class)->updateShippingReceipt(
                        SalesOrderData::fromModel($this->record),
                        data_get($data, 'shipping_receipt_number')
                    );
                }),
        ];
    }
}
