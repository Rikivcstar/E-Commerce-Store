<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode Kupon')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->formatStateUsing(fn ($state) => $state === 'percent' ? 'Persentase (%)' : 'Potongan (Rp)')
                    ->badge(),

                TextColumn::make('value')
                    ->label('Nilai')
                    ->formatStateUsing(fn ($state, $record) => $record->type === 'percent' ? "{$state}%" : Number::currency($state, 'IDR')),

                TextColumn::make('min_order_amount')
                    ->label('Min. Belanja')
                    ->formatStateUsing(fn ($state) => Number::currency($state, 'IDR')),

                TextColumn::make('usage_info')
                    ->label('Terpakai / Kuota')
                    ->state(fn ($record) => $record->usage_limit !== null ? "{$record->used_count} / {$record->usage_limit}" : "{$record->used_count} / ∞"),

                TextColumn::make('valid_until')
                    ->label('Berlaku Sampai')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Selamanya'),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
