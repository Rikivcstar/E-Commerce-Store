<?php

namespace App\Filament\Widgets;

use App\Services\SalesReportService;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Number;

class TopProductsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 2;

    public function getHeading(): ?string
    {
        return 'Produk Terlaris';
    }

    public function table(Table $table): Table
    {
        $service = app(SalesReportService::class);

        return $table
            ->query($service->topProducts(10))
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
                TextColumn::make('total_sold')
                    ->label('Terjual')
                    ->badge()
                    ->color('success'),
            ])
            ->paginated(false);
    }
}