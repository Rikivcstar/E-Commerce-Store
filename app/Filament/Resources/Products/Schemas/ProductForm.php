<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([


                    SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover'),
                    SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple(),
                    TextInput::make('name')
                            ->label('Product Name'),
                    TextInput::make('sku')
                            ->label('SKU')
                            ->unique(ignoreRecord: true),
                    TextInput::make('slug')
                            ->unique(ignoreRecord:true),
                    Select::make('categories')
                            ->label('Category')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    SpatieTagsInput::make('tags')
                            ->type('collection')
                            ->label('Collection'),
                    TextInput::make('stock')
                            ->label('Stock Product')
                            ->numeric()
                            ->default(0),
                    TextInput::make('price')
                            ->label('Pricing')
                            ->numeric()
                            ->prefix('Rp.'),
                            TextInput::make('weight')
                            ->label('Weight')
                            ->numeric()
                            ->suffix('gram'),
                    MarkdownEditor::make('description'),
                //


            ]);
    }
}
