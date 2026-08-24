<?php

namespace App\Filament\Resources\ProductQuestions;

use App\Filament\Resources\ProductQuestions\Pages\EditProductQuestion;
use App\Filament\Resources\ProductQuestions\Pages\ListProductQuestions;
use App\Filament\Resources\ProductQuestions\Schemas\ProductQuestionForm;
use App\Filament\Resources\ProductQuestions\Tables\ProductQuestionsTable;
use App\Models\ProductQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductQuestionResource extends Resource
{
    protected static ?string $model = ProductQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static UnitEnum|string|null $navigationGroup = 'Catalogues';

    protected static ?int $navigationSort = 4;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return ProductQuestionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductQuestions::route('/'),
            'edit' => EditProductQuestion::route('/{record}/edit'),
        ];
    }
}