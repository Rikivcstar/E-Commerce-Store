<div>
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-10 pr-6 border-r border-gray-500 md:col-span-3">
                <div>
                    <div class="space-y-3">
                        <input wire:model.live.debounce.250ms='search' type="text" placeholder="Search Your Product"
                            class="@error('search')
                                border-red-600
                            @enderror py-2.5 sm:py-3 px-4 block w-full bg-transparent text-[#FEE715] border-[#FEE715] rounded-lg sm:text-sm focus:border-yellow-500 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none ">
                            @error('search')
                                <p class="text-red-600 text-xs">{{ $message }}</p>
                            @enderror
                    </div>
                    <span class="block mt-5 mb-5 text-lg font-bold text-[#FEE715] dark:text-neutral-200">
                        Collections
                    </span>
                    @error('selectCollection.*')
                        <div class="text-red-600 text-xs">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="block space-y-4">

                        @foreach ($collections as $i => $item)
                            <div class="flex items-center justify-between">
                                <div class="flex">
                                    <input wire:model='selectCollection' value="{{ $item->id }}" type="checkbox"
                                        class="shrink-0 mt-0.5 bg-transparent border-yellow-300 rounded-sm text-[#FEE715]focus:ring-yellow-500 checked:border-yellow-400 disabled:opacity-50 disabled:pointer-events-none"
                                        id="hs-default-checkbox-{{ $i }}">
                                    <label for="hs-default-checkbox-{{ $i }}"
                                        class="text-sm font-medium text-[#FEE715] ms-3 dark:text-neutral-400">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                <span class="text-sm text-[#FEE715] font-loght">({{ $item->product_count }})</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-10">
                        <button wire:click='applySeacrh' wire:loading.attr='disabled' type="button"
                            class="inline-flex items-center  justify-center px-4 py-3 text-sm font-medium text-slate-700
                             bg-[#FEE715] border border-transparent rounded-lg cursor-pointer gap-x-2 hover:bg-yellow-500 focus:outline-hidden focus:bg-yellow-400 disabled:opacity-50 disabled:pointer-events-none">
                            Apply Filter
                            <div wire:loading  class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full dark:text-white" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        <button wire:click='resetFilter' type="button"
                            class="inline-flex items-center justify-center text-sm font-semibold text-[#FEE715] rounded-lg cursor-pointer gap-x-2 hover:text-yellow-500 border border-[#FEE715] focus:outline-hidden focus:text-yellow-400 disabled:opacity-50 disabled:pointer-events-none">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-7">
                <div class="flex items-center justify-between gap-5">
                    <div class="font-light text-[#FEE715]">Result : {{ ($products) ? $products->total () : 'null' }} items</div>
                    <div class="flex items-center gap-2">
                        <span class="flex flex-col items-end text-md font-light text-[#FEE715] ">
                            Sort By :
                        @error('shortBy')
                            <div class="text-red-600 text-xs">
                                {{ $message }}
                            </div>
                        @enderror
                        </span>

                        <select
                            wire:model='shortBy'
                            class="px-3 py-2 text-[#FEE715] text-sm bg-slate-900 border-yellow-200 rounded-lg pe-9 focus:border-yellow-400 focus:ring-yellow-500 disabled:opacity-50 disabled:pointer-events-none ">
                            <option selected="" class="bg-transparent" >Open this select menu</option>
                            <option value="newest" class="bg-transparent">Product Newst</option>
                            <option value="latest" class="bg-transparent">Product Latest</option>
                            <option value="price_asc" class="bg-transparent">Product Price A-Z</option>
                            <option value="price_desc" class="bg-transparent">Product Price Z-A</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 my-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
                    @forelse ($products as $product )
                        <x-single-product-card :product="$product"/>
                    @empty
                        <div class="font-bold text-2xl col-span-full">
                            Product Not found
                        </div>
                    @endforelse
                </div>
                @if($products)
                    <div>
                    {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
