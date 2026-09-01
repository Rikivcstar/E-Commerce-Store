<div
    class="group relative flex flex-col overflow-hidden rounded-2xl bg-white p-3 shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-md">
    <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-zinc-100">
        <a href="{{ route('product', $product->slug) }}" class="block h-full w-full">
            <img src="{{ $product->cover_url }}" alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        </a>

        @if (isset($product->stock) && $product->stock <= 3 && $product->stock > 0)
            <span
                class="absolute left-2 top-2 z-10 rounded-md bg-rose-600/90 px-2 py-0.5 text-[10px] font-bold text-white shadow-xs backdrop-blur-md uppercase tracking-wider">
                Stok Terbatas
            </span>
        @elseif (isset($product->stock) && $product->stock == 0)
            <span
                class="absolute left-2 top-2 z-10 rounded-md bg-zinc-900/90 px-2 py-0.5 text-[10px] font-bold text-white shadow-xs backdrop-blur-md uppercase tracking-wider">
                Stok Habis
            </span>
        @endif

        @php
            $onSale = isset($product->is_on_sale) && $product->is_on_sale;
        @endphp
        @if ($onSale)
            <span
                class="absolute bottom-2 left-2 z-10 rounded-md bg-[#dc2626] px-2 py-0.5 text-[10px] font-black uppercase tracking-wider text-white shadow-xs">
                ⚡ Sale -{{ $product->discount_percent }}%
            </span>
        @endif

        <div class="absolute right-2.5 top-2.5 z-10">
            <livewire:wishlist-toggle :product="$product" :variant="'icon'" wire:key="card-wish-{{ $product->sku }}" />
        </div>
    </div>

    <div class="mt-2.5 flex flex-1 flex-col justify-between space-y-2 px-0.5">
        <div>
            @php
                $collectionName = !empty($product->collection)
                    ? $product->collection
                    : (!empty($product->short_desc)
                        ? $product->short_desc
                        : 'Curated Goods');
            @endphp
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-[#777c62] mt-2 line-clamp-1">
                {{ $collectionName }}
            </p>

            <a href="{{ route('product', $product->slug) }}" class="focus:outline-none">
                <h3
                    class="text-sm font-bold leading-snug text-zinc-900 transition group-hover:text-[#555a42] line-clamp-2">
                    {{ $product->name }}
                </h3>
            </a>
        </div>

        <div class="pt-0.5 space-y-1">
            @if (isset($product->is_on_sale) && $product->is_on_sale)
                <p class="text-sm sm:text-base font-black text-[#dc2626]">
                    {{ $product->effective_price_formatted }}
                    <span
                        class="ml-1 text-xs font-semibold text-zinc-400 line-through">{{ $product->price_formatted }}</span>
                </p>
            @else
                <p class="text-sm sm:text-base font-black text-zinc-900">{{ $product->price_formatted }}</p>
            @endif

            <div class="flex items-center gap-1.5 text-xs text-zinc-500 font-medium">
                <span class="inline-flex items-center gap-1 font-bold text-zinc-800">
                    <svg class="size-3.5 fill-amber-400 text-amber-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                    4.8
                </span>
                <span class="text-zinc-300">•</span>
                <span class="text-zinc-500">
                    @php
                        $sold =
                            isset($product->sold_count) && $product->sold_count > 0
                                ? $product->sold_count
                                : (isset($product->id)
                                    ? (($product->id * 17) % 75) + 15
                                    : 25);
                    @endphp
                    {{ __('Terjual :count+', ['count' => $sold]) }}
                </span>
            </div>
        </div>
    </div>
</div>
