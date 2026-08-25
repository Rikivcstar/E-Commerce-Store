<?php

namespace App\Filament\Resources\ProductQuestions\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->limit(24),
                TextColumn::make('name')
                    ->label('Penanya')
                    ->formatStateUsing(fn ($record) => $record->user?->name ?? $record->name ?? '-')
                    ->searchable(),
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(60),
                TextColumn::make('answered_at')
                    ->label('Dijawab')
                    ->badge()
                    ->placeholder('Belum')
                    ->dateTime('d M Y'),
                ToggleColumn::make('is_published')
                    ->label('Dipublikasikan')
                    ->disabled(fn () => ! auth()->user()?->can('Update:ProductQuestion')),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Dipublikasikan'),
                SelectFilter::make('product_id')
                    ->label('Produk')
                    ->relationship('product', 'name')
                    ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
