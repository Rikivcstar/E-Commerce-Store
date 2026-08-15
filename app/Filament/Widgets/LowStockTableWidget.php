<?php

namespace App\Filament\Widgets;

use App\Services\SalesReportService;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Number;

class LowStockTableWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    public function getHeading(): ?string
    {
        return 'Peringatan Stok Menipis (Stok ≤ 5)';
    }

    public function table(Table $table): Table
    {
        $service = app(SalesReportService::class);

        return $table
            ->query($service->lowStockQuery(5))
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label('Foto'),
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU'),
                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => Number::currency($state, 'IDR')),
                TextColumn::make('stock')
                    ->label('Sisa Stok')
                    ->badge()
                    ->color(fn ($state) => $state <= 2 ? 'danger' : 'warning'),
            ])
            ->paginated(false);
    }
}
