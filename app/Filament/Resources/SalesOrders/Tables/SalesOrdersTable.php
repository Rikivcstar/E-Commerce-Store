<?php

namespace App\Filament\Resources\SalesOrders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class SalesOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('trx_id')
                    ->label('TRX ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_full_name')
                    ->label('Pelanggan')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state->label())
                    ->badge(),
                TextColumn::make('total')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => Number::currency($state, 'IDR'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        \App\States\SalesOrder\Pending::class => 'Menunggu Pembayaran',
                        \App\States\SalesOrder\Progress::class => 'Proses Pengiriman',
                        \App\States\SalesOrder\Completed::class => 'Pesanan Selesai',
                        \App\States\SalesOrder\Cancel::class => 'Pesanan Dibatalkan',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                \Filament\Actions\Action::make('download_invoice')
                    ->label('Invoice PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn (\App\Models\SalesOrder $record) => route('admin.sales-orders.invoice', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
