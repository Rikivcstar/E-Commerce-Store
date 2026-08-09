<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Page Title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $record) {
                        if (! blank($state) && blank($record)) {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('excerpt')
                    ->label('Short Description / Excerpt (for Homepage Cards)')
                    ->rows(2)
                    ->nullable(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                Toggle::make('is_featured')
                    ->label('Show on Homepage')
                    ->default(false),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('image')
                    ->label('Banner / Feature Image')
                    ->image()
                    ->imageEditor(),
                MarkdownEditor::make('context')
                    ->label('Page Content')
                    ->nullable(),
            ]);
    }
}
