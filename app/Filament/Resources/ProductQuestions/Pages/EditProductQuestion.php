<?php

namespace App\Filament\Resources\ProductQuestions\Pages;

use App\Filament\Resources\ProductQuestions\ProductQuestionResource;
use Filament\Resources\Pages\EditRecord;

class EditProductQuestion extends EditRecord
{
    protected static string $resource = ProductQuestionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Set waktu jawaban otomatis saat pertama kali dijawab.
        if (filled($data['answer'] ?? null) && blank($this->getRecord()->answered_at)) {
            $data['answered_at'] = now();
        }

        return $data;
    }
}