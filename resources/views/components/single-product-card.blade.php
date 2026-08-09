<a href="{{ route('product', $product->slug) }}" class="group block" data-aos="fade-up" data-aos-delay="30">
    <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-zinc-100">
        <img
            src="{{ $product->cover_url }}"
            alt="{{ $product->name }}"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            loading="lazy">
        <button type="button"
            class="absolute right-2.5 top-2.5 flex size-8 items-center justify-center rounded-full bg-white/90 text-zinc-500 opacity-0 shadow-sm transition duration-200 group-hover:opacity-100 hover:text-rose-500">
            <i data-lucide="heart" class="size-4"></i>
        </button>
    </div>
    <div class="mt-3 space-y-1 px-0.5">
        <h3 class="line-clamp-2 text-sm font-semibold leading-snug text-zinc-900 transition group-hover:text-indigo-700">
            {{ $product->name }}
        </h3>
        <div class="flex items-center justify-between gap-2">
            <p class="text-sm font-bold text-zinc-900">{{ $product->price_formatted }}</p>
            <span class="flex items-center gap-0.5 text-xs font-medium text-amber-500">
                <i data-lucide="star" class="size-3 fill-amber-400 text-amber-400"></i>
                4.8
            </span>
        </div>
    </div>
</a>
