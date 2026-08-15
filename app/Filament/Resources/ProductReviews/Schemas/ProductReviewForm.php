<?php

namespace App\Filament\Resources\ProductReviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('product.name')
                    ->label('Produk')
                    ->disabled(),
                TextInput::make('user.name')
                    ->label('Pelanggan')
                    ->disabled(),
                Select::make('rating')
                    ->label('Rating')
                    ->options([
                        5 => '5 - Sangat Baik',
                        4 => '4 - Baik',
                        3 => '3 - Cukup',
                        2 => '2 - Kurang',
                        1 => '1 - Buruk',
                    ])
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul')
                    ->columnSpanFull(),
                Textarea::make('body')
                    ->label('Ulasan')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                Toggle::make('is_approved')
                    ->label('Disetujui (tampil di frontstore)')
                    ->default(false),
            ]);
    }
}
