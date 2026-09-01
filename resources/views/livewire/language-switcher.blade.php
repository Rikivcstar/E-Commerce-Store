<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" @click.outside="open = false" type="button"
        class="flex items-center gap-1.5 rounded-full px-3 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]"
        aria-label="Bahasa / Language">
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
            <path d="M2 12h20" />
        </svg>
        <span class="uppercase">{{ strtoupper($current) }}</span>
        <svg class="size-3 transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div x-show="open" x-transition style="display: none;"
        class="absolute right-0 mt-2 w-36 rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-black/10 z-50">
        @foreach ($locales as $code => $label)
            <a href="{{ \App\Support\LocaleUrl::for($code) }}" wire:navigate
                @click="open = false"
                class="flex items-center justify-between rounded-xl px-3 py-2 text-xs font-bold transition {{ $code === $current ? 'bg-[#f2f3ed] text-[#20221b]' : 'text-gray-600 hover:bg-[#f2f3ed] hover:text-black' }}">
                {{ $label }}
                @if ($code === $current)
                    <svg class="size-3.5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
