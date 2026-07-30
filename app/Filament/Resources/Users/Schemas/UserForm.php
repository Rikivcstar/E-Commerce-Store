<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->maxLength(255)
                    ->inlineLabel(),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique()
                    ->maxLength(255)
                    ->inlineLabel(),
                Select::make('roles')
                    ->required()
                    ->multiple()
                    ->preload()
                    ->relationship('roles', 'name'),
                Fieldset::make('Password')
                    ->schema([
                        TextInput::make('password')
                            ->same('password_confirmation')
                            ->password()
                            ->maxLength(255)
                            ->revealable()
                            ->required(fn($record) => $record == null)
                            ->dehydrateStateUsing(fn($state) => ! empty($state) ? Hash::make($state) : ''),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->revealable()
                            ->maxLength(255)
                    ])
            ])
            ->columns(1);
    }
}
