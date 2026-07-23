<div>
      <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid gap-10 md:grid-cols-10">
            <div class="md:col-span-6 bg-white border border-[#e2e8f0] p-6 md:p-8 rounded-2xl shadow-xs">
                <!-- Section -->
                <div class="py-6 border-b border-[#e2e8f0] first:pt-0 last:pb-0 first:border-transparent">
                    <h2 class="text-lg font-bold text-[#0f2d5a] mb-4">Billing Contact</h2>

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider mb-1.5">Full Name</label>
                            <input id="af-payment-billing-contact" wire:model='data.full_name' type="text"
                                class="@error('data.full_name')
                                    border-red-600
                                @enderror py-2.5 px-3 block w-full bg-white border-[#e2e8f0] text-[#0f2d5a] placeholder-slate-400 shadow-2xs sm:text-sm rounded-lg focus:border-[#1e40af] focus:ring-[#1e40af]/30"
                                placeholder="Full Name">
                                @error('data.full_name')
                                    <p class="mt-2 text-xs text-red-600 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider mb-1.5">Email Address</label>
                            <input type="text" wire:model='data.email'
                                class="@error('data.email')
                                    border-red-600
                                @enderror py-2.5 px-3 block w-full bg-white border-[#e2e8f0] text-[#0f2d5a] placeholder-slate-400 shadow-2xs sm:text-sm rounded-lg focus:border-[#1e40af] focus:ring-[#1e40af]/30"
                                placeholder="Email">
                                @error('data.email')
                                    <p class="mt-2 text-xs text-red-600 font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider mb-1.5">Phone Number</label>
                            <input type="text" wire:model='data.phone'
                                class="@error('data.phone')
                                    border-red-600
                                @enderror py-2.5 px-3 block w-full bg-white border-[#e2e8f0] text-[#0f2d5a] placeholder-slate-400 shadow-2xs sm:text-sm rounded-lg focus:border-[#1e40af] focus:ring-[#1e40af]/30"
                                placeholder="Phone Number">
                            @error('data.phone')
                                <p class="mt-2 text-xs text-red-600 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section -->
                <div class="py-6 border-b border-[#e2e8f0]">
                    <h2 class="text-lg font-bold text-[#0f2d5a] mb-4">Billing Address</h2>

                    <div class="mt-2 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider mb-1.5">Street Address</label>
                            <input id="af-payment-billing-address" wire:model='data.address_line' type="text"
                                class="@error('data.address_line')
                                    border-red-600
                                @enderror py-2.5 px-3 block w-full bg-white border-[#e2e8f0] text-[#0f2d5a] placeholder-slate-400 shadow-2xs sm:text-sm rounded-lg focus:border-[#1e40af] focus:ring-[#1e40af]/30"
                                placeholder="Street Address">
                            @error('data.address_line')
                                <p class="mt-2 text-xs text-red-600 font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider mb-1.5">Cari Lokasi / Kota / Kecamatan</label>
                            @php
                                $regionList = [];
                                try {
                                    if ($this->regions) {
                                        foreach ($this->regions as $r) {
                                            $regionList[] = $r;
                                        }
                                    }
                                } catch (\Throwable $e) {
                                    $regionList = [];
                                }

                                try {
                                    $selectedRegion = $this->region;
                                } catch (\Throwable $e) {
                                    $selectedRegion = null;
                                }
                            @endphp
                            <div x-data="{ open: false }" class="relative w-full">
                                <div class="relative">
                                    <input type="text"
                                        wire:model.live.debounce.500ms='region_selector.keyword'
                                        x-on:focus="open = true"
                                        x-on:click.outside="open = false"
                                        class="py-2.5 px-3 block w-full bg-white border-[#e2e8f0] text-[#0f2d5a] placeholder-slate-400 shadow-2xs sm:text-sm rounded-lg focus:border-[#1e40af] focus:ring-[#1e40af]/30"
                                        placeholder="Ketik nama kota atau kecamatan...">

                                    <div wire:loading wire:target='region_selector.keyword' class="absolute right-3 top-3.5 animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#1e40af] rounded-full" role="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                @if(count($regionList) > 0)
                                    <ul class="absolute z-10 w-full mt-1 overflow-y-auto bg-white border border-[#e2e8f0] rounded-b-lg max-h-60 shadow-lg" x-show="open" x-cloak>
                                        @foreach ($regionList as $region)
                                            @php $rCode = data_get($region, 'code'); $rLabel = data_get($region, 'label'); @endphp
                                            <li wire:key="region-{{ $rCode }}" class="p-2.5 cursor-pointer hover:bg-[#f8fafc] text-sm text-[#0f2d5a]">
                                                <label for="region-{{ $rCode }}" class="w-full inline-block cursor-pointer">
                                                    <input type="radio" value="{{ $rCode }}" wire:model.live='region_selector.region_selected' class="sr-only" id="region-{{ $rCode }}">
                                                    {{ $rLabel }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if($selectedRegion)
                                    <div class="mt-2.5 p-3 bg-[#f8fafc] border border-[#e2e8f0] rounded-lg text-sm text-[#0f2d5a] flex items-center gap-2">
                                        <svg class="size-4 text-[#1e40af] shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        <span>Lokasi Dipilih: <strong class="font-semibold text-[#1e40af]">{{ data_get($selectedRegion, 'label') }}</strong></span>
                                    </div>
                                @endif
                            </div>
                            @error('data.destination_region_code')
                            <p class="mt-2 text-xs text-red-600 font-medium">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Shipping Method Section -->
                <div class="py-6 border-b border-[#e2e8f0]">
                    <h2 class="text-lg font-bold text-[#0f2d5a] mb-4">Shipping Method</h2>

                      @error('data.shipping_hash')
                            <p class="mt-2 text-xs text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        @enderror
                    <div class="w-full relative flex justify-center">
                         <div wire:loading wire:target='region_selector.region_selected' class=" animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#1e40af] rounded-full" role="status" aria-label="loading">
                             <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @forelse ($this->shipping_methods as $group_name => $shipping_method_groups)
                            <div class="text-xs font-bold">
                                {{ $group_name }}
                            </div>

                            @foreach ($shipping_method_groups as $i => $shipping_method)
                                 <label for="shipping_method_{{ $shipping_method->hash }}"
                                    class="flex items-center justify-between w-full gap-4 p-3.5 bg-white border border-[#e2e8f0] rounded-xl hover:bg-[#f8fafc] cursor-pointer transition-colors duration-150">
                                    <div class="flex items-center gap-3">
                                        <input
                                        wire:key='{{ $shipping_method->hash }}'
                                        wire:model.live='data.shipping_hash'
                                         type="radio"
                                         value="{{ $shipping_method->hash }}"
                                         class ="shrink-0 mt-0.5 border-[#cbd5e1] rounded-full text-[#1e40af] focus:ring-[#1e40af] checked:border-[#1e40af]"
                                            id="shipping_method_{{ $shipping_method->hash }}">
                                        @if($shipping_method->logo_url)
                                        <img src="{{ $shipping_method->logo_url }}" class="h-5" alt="J&T Express" />
                                        @endif
                                        <span class="text-sm font-semibold text-[#0f2d5a] ms-1">
                                          {{ $shipping_method->label }}
                                        </span>
                                    </div>
                                    <span class="text-sm font-bold text-[#1e40af]">
                                        {{ $shipping_method->cost_formatted }}
                                    </span>
                                </label>
                            @endforeach
                        @empty
                              <div class="text-xs font-semibold text-red-600 bg-red-50 border border-red-100 rounded-lg p-3">
                                Please fill in the Shipping Address above first.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="py-6 last:pb-0">
                    <h2 class="text-lg font-bold text-[#0f2d5a] mb-4">Payment Method</h2>
                     @error('data.payment_method_hash')
                        <p class="mt-2 text-xs text-red-600 font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                    <div class="space-y-3">
                        <div class="grid space-y-2">
                            @foreach ($this->payment_methods->toCollection() as $key => $payment_method)
                                <label for="payment_method_{{ $payment_method->label }}"
                                    class="flex w-full items-center p-3.5 bg-white border border-[#e2e8f0] rounded-xl hover:bg-[#f8fafc] cursor-pointer transition-colors duration-150">
                                    <input type="radio"
                                        wire:key='payment_method-{{ $payment_method->hash }}'
                                        wire:model='payment_method_selector.payment_method_selected'
                                        value="{{ $payment_method->hash }}"
                                        class="shrink-0 mt-0.5 border-[#cbd5e1] rounded-full text-[#1e40af] focus:ring-[#1e40af] checked:border-[#1e40af]"
                                        id="payment_method_{{ $payment_method->hash }}">
                                    <span class="text-sm font-semibold text-[#0f2d5a] ms-3">{{ $payment_method->label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="md:col-span-4 flex flex-col gap-6">
                <div class="bg-white border border-[#e2e8f0] p-6 md:p-8 rounded-2xl shadow-xs">
                    <h1 class="mb-6 text-xl font-extrabold text-[#0f2d5a]">Order Summary</h1>

                    <div class="divide-y divide-[#e2e8f0] mb-6">
                        @foreach ($cart->items as $item)
                            <div class="py-3.5 first:pt-0 last:pb-0">
                                <x-single-product-list :cart_item="$item" />
                            </div>
                        @endforeach
                    </div>

                    <div class="grid gap-4 pt-4 border-t border-[#e2e8f0]">
                        <!-- List Group -->
                        <ul class="flex flex-col border border-[#e2e8f0] rounded-xl overflow-hidden bg-[#f8fafc]">
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Sub Total</span>
                                    <span class="text-[#0f2d5a] font-semibold">{{ data_get($this->summary, 'sub_total_formatted') }}</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span class="flex flex-col">
                                        <span>{{ $this->shippingMethod->label ?? "-" }}</span>
                                        <span class="text-xs text-[#4b6489]/75 mt-0.5">
                                            {{ $this->shippingMethod?->weight ?? 0 }} grams</span>
                                    </span>
                                    <span class="relative text-[#0f2d5a] font-semibold">
                                        {{ data_get($this->summary, 'shipping_total_formatted') }}
                                        <div
                                        wire:loading
                                        wire:target='data.shipping_hash' class="animate-spin inline-block size-4 border-3 border-current x  border-t-transparent text-[#1e40af] rounded-full" role="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>

                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-4 text-sm font-bold text-[#0f2d5a] bg-white">
                                <div class="flex items-center justify-between w-full">
                                    <span>Total Amount</span>
                                    <span class="text-lg text-[#1e40af]">{{ data_get($this->summary, 'grand_total_formatted') }}</span>
                                </div>
                            </li>
                        </ul>
                        <!-- End List Group -->
                        <button type="button"
                            wire:click='placeAnOrder()'
                            wire:loading.attr='disabled'
                            class="inline-flex items-center justify-center w-full px-4 py-3.5 text-sm font-bold text-white bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg transition-colors duration-250 shadow-md">
                            Place an Order
                            <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                                 <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
