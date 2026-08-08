<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.outside="open = false" type="button"
        class="inline-flex items-center gap-1 rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]">
        Categories
        <svg class="size-4 transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div x-show="open" x-transition x-cloak
        class="absolute left-0 top-full z-50 mt-2 w-64 overflow-hidden rounded-[1.25rem] bg-white/95 p-2 shadow-xl shadow-[#555a42]/10 ring-1 ring-black/5 backdrop-blur-xl">
        <a href="{{ route('product-catalog') }}"
            class="flex items-center justify-between rounded-xl px-4 py-2.5 text-sm font-bold text-[#20221b] transition hover:bg-[#f2f3ed]">
            All products
            <span class="text-xs font-bold text-[#8c9082]">↗</span>
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('product-catalog', ['selectCategory' => [$category->id]]) }}"
                class="flex items-center justify-between rounded-xl px-4 py-2.5 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]">
                {{ $category->name }}
                <span class="text-xs font-bold text-[#8c9082]">{{ $category->products_count }}</span>
            </a>
            @foreach ($category->children as $child)
                <a href="{{ route('product-catalog', ['selectCategory' => [$child->id]]) }}"
                    class="ms-4 flex items-center justify-between rounded-xl px-4 py-2 text-sm font-semibold text-[#777c62] transition hover:bg-[#f2f3ed] hover:text-[#20221b]">
                    {{ $child->name }}
                </a>
            @endforeach
        @endforeach
    </div>
</div>