<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

trait HasTranslatableFormAttributes
{
    protected static array $translatableFormFields = [];

    public static function getTranslatableFormFields(): array
    {
        return static::$translatableFormFields;
    }

    public static function getTranslatableFormLocales(): array
    {
        return array_keys(config('app.available_locales'));
    }

    public static function extractTranslatableData(array $data, Model $record): array
    {
        foreach (static::getTranslatableFormLocales() as $locale) {
            foreach (static::getTranslatableFormFields() as $field) {
                $key = "{$field}_{$locale}";
                if (isset($data[$key])) {
                    $record->{$key} = $data[$key];
                    unset($data[$key]);
                }
            }
        }

        return $data;
    }

    public function __set(string $key, mixed $value): void
    {
        foreach (static::$translatableFormFields as $field) {
            foreach (static::getTranslatableFormLocales() as $locale) {
                if ($key === "{$field}_{$locale}") {
                    $this->setTranslation($field, $locale, $value);
                    return;
                }
            }
        }

        parent::__set($key, $value);
    }

    public function __get(string $key): mixed
    {
        foreach (static::$translatableFormFields as $field) {
            foreach (static::getTranslatableFormLocales() as $locale) {
                if ($key === "{$field}_{$locale}") {
                    return $this->getTranslation($field, $locale);
                }
            }
        }

        return parent::__get($key);
    }
}