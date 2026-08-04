<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true),
                MarkdownEditor::make('context')
                    ->nullable()
            ])->columns(1);
    }
}
