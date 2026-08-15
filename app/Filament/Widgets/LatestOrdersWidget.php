<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SalesOrders\SalesOrderResource;
use App\Models\SalesOrder;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Number;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): ?string
    {
        return 'Transaksi Terbaru';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SalesOrder::query()
                    ->with('user')
                    ->latest('created_at')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('trx_id')
                    ->label('TRX ID')
                    ->searchable(),
                TextColumn::make('customer_full_name')
                    ->label('Pelanggan'),
                TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => Number::currency($state, 'IDR')),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => is_object($state) && method_exists($state, 'label') ? $state->label() : (string) $state)
                    ->badge()
                    ->color(fn ($state) => match (is_object($state) ? get_class($state) : (string) $state) {
                        \App\States\SalesOrder\Pending::class => 'warning',
                        \App\States\SalesOrder\Progress::class => 'info',
                        \App\States\SalesOrder\Completed::class => 'success',
                        \App\States\SalesOrder\Cancel::class => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i'),
            ])
            ->recordUrl(
                fn (SalesOrder $record): string => SalesOrderResource::getUrl('view', ['record' => $record])
            )
            ->recordActions([
                ViewAction::make()
                    ->url(fn (SalesOrder $record): string => SalesOrderResource::getUrl('view', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
