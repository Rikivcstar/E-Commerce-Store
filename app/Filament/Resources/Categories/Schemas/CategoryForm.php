<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $record) {
                        if (! blank($state) && blank($record)) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true),
                Select::make('parent_id')
                    ->label('Parent Category')
                    ->nullable()
                    ->searchable()
                    ->options(fn ($record) => Category::query()
                        ->whereKeyNot($record?->id)
                        ->orderBy('order_column')
                        ->pluck('name', 'id')),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                TextInput::make('order_column')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0),
                MarkdownEditor::make('description')
                    ->nullable(),
                \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->label('Category Banner / Image')
                    ->image()
                    ->imageEditor(),
            ]);
    }
}