<?php

namespace App\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public array $locales = [];

    public string $current = 'id';

    public function mount(): void
    {
        $this->locales = config('app.available_locales', ['id' => 'Indonesia', 'en' => 'English']);
        $this->current = app()->getLocale();
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
