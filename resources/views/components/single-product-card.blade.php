<div
    class="group relative flex flex-col overflow-hidden rounded-2xl bg-white p-3 shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-md">
    <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-zinc-100">
        <a href="{{ route('product', $product->slug) }}" class="block h-full w-full">
            <img src="{{ $product->cover_url }}" alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        </a>
        <div class="absolute right-2.5 top-2.5 z-10">
            <livewire:wishlist-toggle :product="$product" :variant="'icon'" wire:key="card-wish-{{ $product->sku }}" />
        </div>
    </div>
    <div class="mt-3 flex flex-1 flex-col justify-between space-y-2 px-0.5">
        <div>
            <a href="{{ route('product', $product->slug) }}" class="focus:outline-none">
                <h3 class=" text-sm font-bold leading-snug text-zinc-900 transition group-hover:text-[#555a42]">
                    {{ $product->name }}
                </h3>
            </a>
        </div>
        <div class="flex items-center justify-between gap-2 pt-1 border-t border-zinc-100">
            <p class="text-sm font-black text-zinc-900">{{ $product->price_formatted }}</p>
            <span class="flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-xs font-bold text-amber-600">
                <svg class="size-3.5 fill-amber-400 text-amber-400" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="currentColor">
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
                4.8
            </span>
        </div>
    </div>
</div>
