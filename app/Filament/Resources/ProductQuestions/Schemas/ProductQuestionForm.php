<?php

namespace App\Filament\Resources\ProductQuestions\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('product.name')
                    ->label('Produk')
                    ->disabled(),
                TextInput::make('name')
                    ->label('Penanya')
                    ->formatStateUsing(fn ($record) => $record->user?->name ?? $record->name ?? '-')
                    ->disabled(),
                Textarea::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('answer')
                    ->label('Jawaban')
                    ->rows(5)
                    ->hint('Isi jawaban lalu publikasikan untuk menampilkan di halaman produk.')
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Publikasikan (tampil di frontstore)')
                    ->default(false),
            ]);
    }
}