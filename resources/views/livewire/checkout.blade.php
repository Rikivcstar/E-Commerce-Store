<div>
    <style>
        .checkout-page { background: #f7f2e8; padding: 2rem clamp(1rem, 3vw, 2.5rem) 4rem; }
        .checkout-shell { max-width: 92rem; margin: 0 auto; }
        .checkout-header { margin-bottom: 1.5rem; }
        .checkout-kicker { color: #8b7659; font-size: .75rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .checkout-title { margin-top: .45rem; color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: clamp(2.6rem, 6vw, 5.5rem); font-weight: 900; line-height: .86; text-transform: uppercase; }
        .checkout-grid { display: grid; gap: 1.5rem; align-items: start; }
        .checkout-card { border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 1.5rem; box-shadow: 0 18px 45px rgba(79,68,48,.08); overflow: hidden; }
        .checkout-section { padding: 1.25rem; border-bottom: 1px solid #d7c7ad; }
        .checkout-section:last-child { border-bottom: 0; }
        .checkout-section h2, .checkout-summary-title { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 1.65rem; font-weight: 900; text-transform: uppercase; }
        .checkout-field-grid { display: grid; gap: 1rem; margin-top: 1rem; }
        .checkout-field label { display: block; margin-bottom: .45rem; color: #77664c; font-size: .72rem; font-weight: 900; letter-spacing: .12em; text-transform: uppercase; }
        .checkout-input { width: 100%; min-height: 3rem; border: 1px solid #d7c7ad; border-radius: 1rem; background: #f9f1e4; color: #211b14; padding: .75rem 1rem; outline: none; }
        .checkout-input:focus { border-color: #8b7659; box-shadow: 0 0 0 3px rgba(139,118,89,.14); }
        .checkout-error { margin-top: .5rem; color: #b42318; font-size: .75rem; font-weight: 800; }
        .checkout-choice { display: flex; align-items: center; justify-content: space-between; gap: 1rem; width: 100%; padding: 1rem; border: 1px solid #d7c7ad; border-radius: 1.1rem; background: #f9f1e4; cursor: pointer; transition: .2s ease; }
        .checkout-choice:hover { background: #f3eadc; border-color: #bda987; }
        .checkout-choice input { accent-color: #4d4634; }
        .checkout-choice-title { color: #211b14; font-size: .95rem; font-weight: 900; }
        .checkout-choice-price { color: #4d4634; font-size: .9rem; font-weight: 900; white-space: nowrap; }
        .checkout-list { display: grid; gap: .75rem; margin-top: 1rem; }
        .checkout-muted-box { margin-top: .75rem; padding: .85rem 1rem; border: 1px solid #d7c7ad; border-radius: 1rem; background: #f3eadc; color: #5d523f; font-size: .9rem; }
        .checkout-dropdown { position: absolute; z-index: 30; width: 100%; margin-top: .35rem; max-height: 15rem; overflow: auto; border: 1px solid #d7c7ad; border-radius: 1rem; background: #fffaf2; box-shadow: 0 18px 38px rgba(79,68,48,.12); }
        .checkout-dropdown li { padding: .8rem 1rem; color: #211b14; font-size: .9rem; cursor: pointer; }
        .checkout-dropdown li:hover { background: #f3eadc; }
        .checkout-summary { padding: 1.25rem; position: sticky; top: 6rem; }
        .summary-products { margin-top: 1rem; display: grid; gap: .75rem; }
        .summary-box { margin-top: 1rem; border: 1px solid #d7c7ad; border-radius: 1.1rem; overflow: hidden; background: #f8f0e2; }
        .summary-row { display: flex; justify-content: space-between; gap: 1rem; padding: 1rem; color: #5d523f; font-size: .95rem; border-bottom: 1px solid #d7c7ad; }
        .summary-row:last-child { border-bottom: 0; background: #fffaf2; color: #211b14; font-weight: 900; }
        .summary-row strong { color: #4d4634; }
        .place-order-btn { margin-top: 1rem; width: 100%; height: 3.35rem; border: 0; border-radius: 999px; background: #4d4634; color: #fffaf2; font-size: .9rem; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 0 14px 26px rgba(77,70,52,.16); transition: .2s ease; }
        .place-order-btn:hover { transform: translateY(-2px); background: #2f2a20; }
        @media (min-width: 760px) { .checkout-field-grid.two { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 980px) { .checkout-grid { grid-template-columns: minmax(0, 1fr) 28rem; } }
    </style>

    <div class="checkout-page">
        <div class="checkout-shell">
            <div class="checkout-header">
                <p class="checkout-kicker">Secure checkout</p>
                <h1 class="checkout-title">Complete your order.</h1>
            </div>

            <div class="checkout-grid">
                <section class="checkout-card">
                    <div class="checkout-section">
                        <h2>Billing contact</h2>
                        <div class="checkout-field-grid two">
                            <div class="checkout-field" style="grid-column: 1 / -1;">
                                <label>Full name</label>
                                <input wire:model='data.full_name' type="text" class="checkout-input @error('data.full_name') border-red-600 @enderror" placeholder="Full Name">
                                @error('data.full_name')<p class="checkout-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="checkout-field">
                                <label>Email address</label>
                                <input type="text" wire:model='data.email' class="checkout-input @error('data.email') border-red-600 @enderror" placeholder="Email">
                                @error('data.email')<p class="checkout-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="checkout-field">
                                <label>Phone number</label>
                                <input type="text" wire:model='data.phone' class="checkout-input @error('data.phone') border-red-600 @enderror" placeholder="Phone Number">
                                @error('data.phone')<p class="checkout-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Billing address</h2>
                        <div class="checkout-field-grid">
                            <div class="checkout-field">
                                <label>Street address</label>
                                <input wire:model='data.address_line' type="text" class="checkout-input @error('data.address_line') border-red-600 @enderror" placeholder="Street Address">
                                @error('data.address_line')<p class="checkout-error">{{ $message }}</p>@enderror
                            </div>

                            <div class="checkout-field">
                                <label>Cari lokasi / kota / kecamatan</label>
                                @php
                                    $regionList = [];
                                    try {
                                        if ($this->regions) {
                                            foreach ($this->regions as $r) { $regionList[] = $r; }
                                        }
                                    } catch (\Throwable $e) { $regionList = []; }

                                    try { $selectedRegion = $this->region; } catch (\Throwable $e) { $selectedRegion = null; }
                                @endphp
                                <div x-data="{ open: false }" class="relative w-full">
                                    <input type="text" wire:model.live.debounce.500ms='region_selector.keyword' x-on:focus="open = true" x-on:click.outside="open = false" class="checkout-input" placeholder="Ketik nama kota atau kecamatan...">
                                    <div wire:loading wire:target='region_selector.keyword' class="absolute right-4 top-4 animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#4d4634] rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>

                                    @if(count($regionList) > 0)
                                        <ul class="checkout-dropdown" x-show="open" x-cloak>
                                            @foreach ($regionList as $region)
                                                @php $rCode = data_get($region, 'code'); $rLabel = data_get($region, 'label'); @endphp
                                                <li wire:key="region-{{ $rCode }}">
                                                    <label for="region-{{ $rCode }}" class="w-full inline-block cursor-pointer">
                                                        <input type="radio" value="{{ $rCode }}" wire:model.live='region_selector.region_selected' class="sr-only" id="region-{{ $rCode }}">
                                                        {{ $rLabel }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if($selectedRegion)
                                        <div class="checkout-muted-box">Lokasi dipilih: <strong>{{ data_get($selectedRegion, 'label') }}</strong></div>
                                    @endif
                                </div>
                                @error('data.destination_region_code')<p class="checkout-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Shipping method</h2>
                        @error('data.shipping_hash')<p class="checkout-error">{{ $message }}</p>@enderror
                        <div class="w-full relative flex justify-center">
                            <div wire:loading wire:target='region_selector.region_selected' class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#4d4634] rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>
                        </div>
                        <div class="checkout-list">
                            @forelse ($this->shipping_methods as $group_name => $shipping_method_groups)
                                <p class="checkout-kicker">{{ $group_name }}</p>
                                @foreach ($shipping_method_groups as $i => $shipping_method)
                                    <label for="shipping_method_{{ $shipping_method->hash }}" class="checkout-choice">
                                        <span class="flex items-center gap-3">
                                            <input wire:key='{{ $shipping_method->hash }}' wire:model.live='data.shipping_hash' type="radio" value="{{ $shipping_method->hash }}" id="shipping_method_{{ $shipping_method->hash }}">
                                            @if($shipping_method->logo_url)<img src="{{ $shipping_method->logo_url }}" class="h-5" alt="{{ $shipping_method->label }}" />@endif
                                            <span class="checkout-choice-title">{{ $shipping_method->label }}</span>
                                        </span>
                                        <span class="checkout-choice-price">{{ $shipping_method->cost_formatted }}</span>
                                    </label>
                                @endforeach
                            @empty
                                <div class="checkout-muted-box text-red-700">Please fill in the Shipping Address above first.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Payment method</h2>
                        @error('data.payment_method_hash')<p class="checkout-error">{{ $message }}</p>@enderror
                        <div class="checkout-list">
                            @foreach ($this->payment_methods->toCollection() as $key => $payment_method)
                                <label for="payment_method_{{ $payment_method->hash }}" class="checkout-choice">
                                    <span class="flex items-center gap-3">
                                        <input type="radio" wire:key='payment_method-{{ $payment_method->hash }}' wire:model='payment_method_selector.payment_method_selected' value="{{ $payment_method->hash }}" id="payment_method_{{ $payment_method->hash }}">
                                        <span class="checkout-choice-title">{{ $payment_method->label }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </section>

                <aside class="checkout-card checkout-summary">
                    <h2 class="checkout-summary-title">Order summary</h2>
                    <div class="summary-products">
                        @foreach ($cart->items as $item)
                            <x-single-product-list :cart_item="$item" />
                        @endforeach
                    </div>
                    <div class="summary-box">
                        <div class="summary-row"><span>Sub total</span><strong>{{ data_get($this->summary, 'sub_total_formatted') }}</strong></div>
                        <div class="summary-row"><span>{{ $this->shippingMethod->label ?? "Shipping" }}<br><small>{{ $this->shippingMethod?->weight ?? 0 }} grams</small></span><strong>{{ data_get($this->summary, 'shipping_total_formatted') }}</strong></div>
                        <div class="summary-row"><span>Total amount</span><strong>{{ data_get($this->summary, 'grand_total_formatted') }}</strong></div>
                    </div>
                    <button type="button" wire:click='placeAnOrder()' wire:loading.attr='disabled' class="place-order-btn">
                        Place an order
                        <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>
                    </button>
                </aside>
            </div>
        </div>
    </div>
</div>
