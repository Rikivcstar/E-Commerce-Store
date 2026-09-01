<div class="bg-[#f7f7f2] px-3 pb-14 pt-6 text-[#20221b] sm:px-5 lg:px-8">
    <div class="mx-auto max-w-[92rem]">
        {{-- ── CATALOG BANNER ───────────────────────────────────── --}}
        <div class="relative mb-6 overflow-hidden rounded-[1.5rem] shadow-sm">
            <img src="{{ asset('images/catalog-banner.png') }}" alt="Catalog Banner"
                class="h-44 w-full object-cover object-right sm:h-56 sm:object-center md:h-64 lg:h-72">
            <div class="absolute inset-0 flex items-center bg-gradient-to-r from-[#f7f4ed] via-[#f7f4ed]/85 to-transparent p-6 sm:p-10">
                <div class="max-w-md">
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">{{ __('Catalog') }}</p>
                    <h1 class="mt-2 font-display text-3xl font-black uppercase leading-none text-[#20221b] sm:text-4xl lg:text-5xl">{{ __('Temukan produk favoritmu') }}</h1>
<div class="mt-4 inline-flex items-center gap-2 rounded-xl bg-white/80 px-3.5 py-1.5 ring-1 ring-black/5 backdrop-blur-sm">
                        <span wire:loading.remove class="text-xs font-medium text-[#686c60]">{{ __('Result:') }}<span class="font-black text-[#20221b]">{{ ($products) ? $products->total() : '0' }}</span> items</span>
                        <span wire:loading class="inline-flex items-center gap-2 text-xs font-medium text-[#686c60]">{{ __('Result:') }}<span class="inline-block h-3.5 w-10 animate-pulse rounded-full bg-neutral-200/80"></span>
                            items
                        </span>
                    </div>
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

                {{-- ── CATEGORIES SEARCHABLE SELECT ── --}}
                <div class="mt-6" x-data="{
                    open: false,
                    searchCat: '',
                    categories: @js($categories),
                    get label() {
                        if (! $wire.selectCategory || $wire.selectCategory.length === 0) {
                            return 'Semua Kategori';
                        }
                        let count = $wire.selectCategory.length;
                        if (count === 1) {
                            let catId = parseInt($wire.selectCategory[0]);
                            let found = null;
                            this.categories.forEach(c => {
                                if (c.id === catId) found = c.name;
                                if (c.children) {
                                    c.children.forEach(child => { if (child.id === catId) found = child.name; });
                                }
                            });
                            return found ? found : '1 Kategori Dipilih';
                        }
                        return count + ' Kategori Dipilih';
                    }
                }">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-[#20221b]">{{ __('Categories') }}</span>
                        <template x-if="$wire.selectCategory && $wire.selectCategory.length > 0">
                            <button type="button" wire:click="$set('selectCategory', [])" class="text-[11px] font-bold text-rose-600 hover:underline cursor-pointer">{{ __('Hapus') }}</button>
                        </template>
                    </div>

                    @error('selectCategory.*')
                        <div class="mb-2 text-xs font-semibold text-red-600">{{ $message }}</div>
                    @enderror

                    <div class="relative z-20">
                        <button type="button" @click="open = !open"
                            class="flex h-11 w-full items-center justify-between rounded-2xl border-0 bg-[#f2f3ed] px-4 text-sm font-bold text-[#20221b] transition hover:bg-[#e6e8de] focus:ring-2 focus:ring-[#777c62]/30 cursor-pointer">
                            <span class="truncate" x-text="label" :class="{ 'text-[#8c9082]': !$wire.selectCategory || $wire.selectCategory.length === 0 }"></span>
                            <svg class="size-4 shrink-0 text-[#8c9082] transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition.origin.top.duration.150ms
                            class="absolute left-0 right-0 top-full z-50 mt-1.5 w-full rounded-2xl border border-[#e2e8f0] bg-white p-3 shadow-xl ring-1 ring-black/5" style="display: none;">
                            
                            {{-- Search Box inside Dropdown --}}
                            <div class="relative mb-2.5">
                                <svg class="pointer-events-none absolute left-3 top-1/2 size-3.5 -translate-y-1/2 text-[#8c9082]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.34-4.34"/>
                                </svg>
                                <input type="text" x-model="searchCat" placeholder="Cari kategori..."
                                    class="h-9 w-full rounded-xl border-0 bg-[#f2f3ed] pl-8 pr-3 text-xs text-[#20221b] placeholder:text-[#8c9082] focus:ring-2 focus:ring-[#777c62]/30">
                            </div>

                            {{-- Categories List --}}
                            <div class="max-h-60 overflow-y-auto space-y-1 pr-1 border-t border-neutral-100 pt-2">
                                <button type="button" wire:click="$set('selectCategory', [])" @click="open = false"
                                    class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-xs font-bold transition text-[#555a42] hover:bg-[#f7f7f2] cursor-pointer">
                                    <span>{{ __('Semua Kategori') }}</span>
                                    @if(empty($selectCategory))
                                        <svg class="size-3.5 text-[#555a42]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    @endif
                                </button>

                                @foreach ($categories as $category)
                                    <div x-show="'{{ strtolower(addslashes($category->name)) }}'.includes(searchCat.toLowerCase()) || {{ count($category->children) > 0 ? 'true' : 'false' }}">
                                        <label class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-xs font-bold transition text-[#555a42] hover:bg-[#f7f7f2] cursor-pointer">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <input type="checkbox" wire:model.live="selectCategory" value="{{ $category->id }}"
                                                    class="size-4 rounded-md border-[#c9ccbd] text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42]">
                                                <span class="truncate">{{ $category->name }}</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-[#8c9082] shrink-0">({{ $category->product_count }})</span>
                                        </label>

                                        @foreach ($category->children as $child)
                                            <label x-show="'{{ strtolower(addslashes($child->name)) }}'.includes(searchCat.toLowerCase())" 
                                                class="flex w-full items-center justify-between rounded-xl pl-6 pr-3 py-1.5 text-xs font-semibold transition text-[#777c62] hover:bg-[#f7f7f2] cursor-pointer">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <input type="checkbox" wire:model.live="selectCategory" value="{{ $child->id }}"
                                                        class="size-3.5 rounded-md border-[#c9ccbd] text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42]">
                                                    <span class="truncate">└ {{ $child->name }}</span>
                                                </div>
                                                <span class="text-[10px] text-[#8c9082] shrink-0">({{ $child->product_count }})</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── COLLECTIONS LIST ── --}}
                <div class="mt-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-black uppercase tracking-wider text-[#20221b]">{{ __('Collections') }}</span>
                        <template x-if="$wire.selectCollection && $wire.selectCollection.length > 0">
                            <button type="button" wire:click="$set('selectCollection', [])" class="text-[11px] font-bold text-rose-600 hover:underline cursor-pointer">{{ __('Hapus') }}</button>
                        </template>
                    </div>

                    @error('selectCollection.*')
                        <div class="mb-2 text-xs font-semibold text-red-600">{{ $message }}</div>
                    @enderror

                    <div class="space-y-1.5 max-h-56 overflow-y-auto pr-1">
                        @foreach ($collections as $item)
                            <label class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3.5 py-2.5 text-xs font-bold text-[#555a42] transition hover:bg-[#e6e8de] cursor-pointer">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <input wire:model.live="selectCollection" value="{{ $item->id }}" type="checkbox"
                                        class="size-4 rounded-md border-[#c9ccbd] bg-white text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42]">
                                    <span class="truncate">{{ $item->name }}</span>
                                </div>
                                <span class="text-[11px] font-bold text-[#8c9082] shrink-0">({{ $item->product_count }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button wire:click='applySearch' wire:loading.attr='disabled' type="button"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-[#555a42] px-4 text-sm font-black text-white transition hover:bg-[#3f4331] disabled:pointer-events-none disabled:opacity-50 cursor-pointer">{{ __('Apply') }}<div wire:loading class="inline-block size-4 animate-spin rounded-full border-2 border-current border-t-transparent text-white" role="status" aria-label="loading">
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </div>
                    </button>
                    <button wire:click='resetFilter' type="button"
                        class="inline-flex h-11 items-center justify-center rounded-full bg-[#f2f3ed] px-4 text-sm font-black text-[#555a42] transition hover:bg-[#e6e8de] cursor-pointer">{{ __('Reset') }}</button>
                </div>
            </aside>

            <section>
                <div class="mb-5 flex flex-col gap-3 rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-black/5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex gap-2 overflow-x-auto scrollbar-hide">
                        @foreach ([
                            ['label' => 'Newest', 'sort' => 'newest'],
                            ['label' => 'Popular', 'sort' => 'popular'],
                            ['label' => 'Sale', 'sort' => 'price_asc'],
                        ] as $chip)
                            <button type="button" wire:click="applySort('{{ $chip['sort'] }}')"
                                class="inline-flex h-10 shrink-0 items-center rounded-full px-4 text-xs font-black transition {{ $shortBy === $chip['sort'] ? 'bg-[#555a42] text-white' : 'bg-[#f2f3ed] text-[#555a42] hover:bg-[#e6e8de]' }}">
                                {{ $chip['label'] }}
                            </button>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-black uppercase tracking-[0.12em] text-[#777c62]">{{ __('Sort') }}</span>
                        @error('shortBy')
                            <div class="text-xs font-semibold text-red-600">{{ $message }}</div>
                        @enderror
                        <select wire:model='shortBy'
                            class="h-10 rounded-full border-0 bg-[#f2f3ed] px-4 pe-9 text-sm font-bold text-[#555a42] focus:ring-2 focus:ring-[#777c62]/30 disabled:pointer-events-none disabled:opacity-50">
                            <option value="newest">{{ __('Product Newest') }}</option>
                            <option value="latest">{{ __('Product Latest') }}</option>
                            <option value="popular">{{ __('Product Popular') }}</option>
                            <option value="price_asc">{{ __('Product Price A-Z') }}</option>
                            <option value="price_desc">{{ __('Product Price Z-A') }}</option>
                        </select>
                    </div>
                </div>

<div wire:loading.remove class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                    @forelse ($products as $product )
                        <x-single-product-card :product="$product"/>
                    @empty
                        <div class="col-span-full rounded-[1.5rem] bg-white py-14 text-center shadow-sm ring-1 ring-black/5">
                            <p class="font-display text-2xl font-black uppercase text-[#20221b]">{{ __('Product not found') }}</p>
                            <p class="mt-2 text-sm text-[#777b6d]">{{ __('Coba kata kunci atau filter koleksi lain.') }}</p>
                        </div>
                    @endforelse
                </div>

                <div wire:loading aria-hidden="true">
                    <x-skeleton.product-grid
                        :count="12"
                        grid="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4" />
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
