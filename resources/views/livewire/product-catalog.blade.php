<div class="bg-[#f7f7f2] px-3 pb-14 pt-6 text-[#20221b] sm:px-5 lg:px-8">
    <div class="mx-auto max-w-[92rem]">
        <div class="mb-6 overflow-hidden rounded-[1.5rem] bg-[#e6e8de] p-6 sm:p-8">
            <div class="grid items-end gap-6 lg:grid-cols-[1fr_.7fr]">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">Catalog</p>
                    <h1 class="mt-2 font-display text-4xl font-black uppercase leading-none text-[#20221b] sm:text-5xl">Temukan produk favoritmu</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-6 text-[#65685c]">Filter koleksi, urutkan produk, dan lanjutkan belanja tanpa mengubah alur checkout yang sudah berjalan.</p>
                </div>
                <div class="rounded-[1.25rem] bg-white/70 p-4 ring-1 ring-black/5 backdrop-blur">
                    <div class="font-medium text-[#686c60]">Result: <span class="font-black text-[#20221b]">{{ ($products) ? $products->total () : '0' }}</span> items</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[20rem_1fr]">
            <aside class="rounded-[1.5rem] bg-white p-5 shadow-sm ring-1 ring-black/5 lg:sticky lg:top-24 lg:self-start">
                <div class="space-y-3">
                    <label class="relative block">
                        <svg class="pointer-events-none absolute left-4 top-1/2 size-5 -translate-y-1/2 text-[#8c9082]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34" /><circle cx="11" cy="11" r="8" />
                        </svg>
                        <input wire:model.live.debounce.250ms='search' type="text" placeholder="Search product"
                            class="@error('search') border-red-600 @enderror h-12 w-full rounded-full border-0 bg-[#f2f3ed] pl-12 pr-4 text-sm text-[#20221b] placeholder:text-[#8c9082] focus:ring-2 focus:ring-[#777c62]/30">
                    </label>
                    @error('search')
                        <p class="text-xs font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-7">
                    <span class="block text-sm font-black uppercase text-[#20221b]">Collections</span>
                    @error('selectCollection.*')
                        <div class="mt-3 text-xs font-semibold text-red-600">{{ $message }}</div>
                    @enderror
                    <div class="mt-4 space-y-3">
                        @foreach ($collections as $i => $item)
                            <div class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                <div class="flex items-center">
                                    <input wire:model='selectCollection' value="{{ $item->id }}" type="checkbox"
                                        class="shrink-0 border-[#c9ccbd] bg-white text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42] checked:border-[#555a42]"
                                        id="hs-default-checkbox-{{ $i }}">
                                    <label for="hs-default-checkbox-{{ $i }}" class="ms-3 text-sm font-bold text-[#555a42]">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                <span class="text-xs font-bold text-[#8c9082]">{{ $item->product_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-7 grid grid-cols-2 gap-3">
                    <button wire:click='applySeacrh' wire:loading.attr='disabled' type="button"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-[#555a42] px-4 text-sm font-black text-white transition hover:bg-[#3f4331] disabled:pointer-events-none disabled:opacity-50">
                        Apply
                        <div wire:loading class="inline-block size-4 animate-spin rounded-full border-2 border-current border-t-transparent text-white" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button wire:click='resetFilter' type="button"
                        class="inline-flex h-11 items-center justify-center rounded-full bg-[#f2f3ed] px-4 text-sm font-black text-[#555a42] transition hover:bg-[#e6e8de]">
                        Reset
                    </button>
                </div>
            </aside>

            <section>
                <div class="mb-5 flex flex-col gap-3 rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-black/5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex gap-2 overflow-x-auto scrollbar-hide">
                        @foreach (['All', 'Newest', 'Popular', 'Sale'] as $chip)
                            <span class="inline-flex h-10 shrink-0 items-center rounded-full bg-[#f2f3ed] px-4 text-xs font-black text-[#555a42]">{{ $chip }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-black uppercase tracking-[0.12em] text-[#777c62]">Sort</span>
                        @error('shortBy')
                            <div class="text-xs font-semibold text-red-600">{{ $message }}</div>
                        @enderror
                        <select wire:model='shortBy'
                            class="h-10 rounded-full border-0 bg-[#f2f3ed] px-4 pe-9 text-sm font-bold text-[#555a42] focus:ring-2 focus:ring-[#777c62]/30 disabled:pointer-events-none disabled:opacity-50">
                            <option selected="">Sort by latest</option>
                            <option value="newest">Product Newest</option>
                            <option value="latest">Product Latest</option>
                            <option value="price_asc">Product Price A-Z</option>
                            <option value="price_desc">Product Price Z-A</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                    @forelse ($products as $product )
                        <x-single-product-card :product="$product"/>
                    @empty
                        <div class="col-span-full rounded-[1.5rem] bg-white py-14 text-center shadow-sm ring-1 ring-black/5">
                            <p class="font-display text-2xl font-black uppercase text-[#20221b]">Product not found</p>
                            <p class="mt-2 text-sm text-[#777b6d]">Coba kata kunci atau filter koleksi lain.</p>
                        </div>
                    @endforelse
                </div>

                @if($products)
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</div>
