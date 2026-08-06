<div>
    <style>
        .linoge-checkout {
            background-color: #eaeae8;
            color: #111111;
            padding: 2.5rem clamp(1rem, 4vw, 3.5rem) 5rem;
        }
        .linoge-shell {
            max-width: 92rem;
            margin: 0 auto;
        }
        .linoge-header {
            margin-bottom: 2.5rem;
        }
        .linoge-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-weight: 900;
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 0.88;
            letter-spacing: -0.03em;
            text-transform: uppercase;
            color: #111111;
        }
        .linoge-grid {
            display: grid;
            gap: 2.5rem;
            align-items: start;
        }
        .linoge-section {
            margin-bottom: 2.5rem;
        }
        .linoge-section-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #111111;
            letter-spacing: -0.01em;
            margin-bottom: 1.25rem;
        }
        .linoge-sub-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #444444;
            margin-bottom: 0.85rem;
        }
        .linoge-field-grid {
            display: grid;
            gap: 1rem;
        }
        .linoge-field-grid.two {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
        @media (min-width: 640px) {
            .linoge-field-grid.two {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        .linoge-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            color: #666666;
            margin-bottom: 0.35rem;
        }
        .linoge-input {
            width: 100%;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            border-radius: 0px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #111111;
            transition: all 0.2s ease;
        }
        .linoge-input:focus {
            background-color: #ffffff;
            border-color: #111111;
            outline: none;
            box-shadow: 0 0 0 1px #111111;
        }
        .linoge-choice {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            width: 100%;
            padding: 1rem 1.2rem;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .linoge-choice:hover {
            border-color: #111111;
            background-color: #ffffff;
        }
        .linoge-choice input[type="radio"] {
            accent-color: #111111;
            width: 1rem;
            height: 1rem;
        }
        .linoge-choice-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: #111111;
        }
        .linoge-choice-price {
            font-size: 0.85rem;
            font-weight: 700;
            color: #111111;
            white-space: nowrap;
        }
        .linoge-error {
            margin-top: 0.35rem;
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .linoge-dropdown {
            position: absolute;
            z-index: 30;
            width: 100%;
            margin-top: 0.25rem;
            max-height: 14rem;
            overflow-y: auto;
            border: 1px solid #111111;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .linoge-dropdown li {
            padding: 0.75rem 1rem;
            color: #111111;
            font-size: 0.85rem;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }
        .linoge-dropdown li:hover {
            background: #f4f4f2;
            font-weight: 600;
        }
        .linoge-summary {
            background-color: #eaeae8;
            position: sticky;
            top: 6rem;
        }
        .linoge-summary-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 1.5rem;
        }
        .linoge-summary-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #111111;
            letter-spacing: -0.01em;
        }
        .linoge-summary-count {
            font-size: 0.85rem;
            font-weight: 700;
            color: #666666;
        }
        .linoge-promocode-row {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .linoge-promocode-input {
            flex-grow: 1;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            padding: 0.65rem 0.85rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .linoge-promocode-btn {
            background-color: #d8d8d4;
            color: #555555;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.65rem 1.25rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .linoge-promocode-btn:hover {
            background-color: #111111;
            color: #ffffff;
        }
        .linoge-breakdown {
            border-top: 1px solid #d4d4d0;
            padding-top: 1.25rem;
            margin-top: 1rem;
            display: grid;
            gap: 0.75rem;
        }
        .linoge-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #555555;
        }
        .linoge-row strong {
            color: #111111;
            font-weight: 700;
        }
        .linoge-row.total {
            border-top: 1px solid #111111;
            padding-top: 1rem;
            margin-top: 0.5rem;
            font-size: 1.1rem;
            font-weight: 900;
            color: #111111;
        }
        .linoge-row.total strong {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
        }
        .linoge-btn-primary {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1.15rem;
            background-color: #111111;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .linoge-btn-primary:hover {
            background-color: #000000;
            opacity: 0.95;
        }
        @media (min-width: 980px) {
            .linoge-grid {
                grid-template-columns: minmax(0, 1fr) 28rem;
            }
        }
    </style>

    <div class="linoge-checkout">
        <div class="linoge-shell">
            <!-- PAGE HEADER -->
            <div class="linoge-header">
                <h1 class="linoge-title">CHECKOUT</h1>
            </div>

            <div class="linoge-grid">
                <!-- MAIN FORM COLUMN -->
                <div class="linoge-main">
                    <!-- SECTION 1: INFORMATION -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Information</h2>

                        <!-- Personal Information -->
                        <div class="mb-6">
                            <div class="flex justify-between items-baseline mb-3">
                                <h3 class="linoge-sub-title">Personal Information</h3>
                                <span class="text-xs text-neutral-500">Already have an account? <a href="#" class="underline text-neutral-900 font-semibold">Log in</a></span>
                            </div>
                            <div class="linoge-field-grid two">
                                <div>
                                    <label class="linoge-label">Full name</label>
                                    <input wire:model='data.full_name' type="text" class="linoge-input @error('data.full_name') border-red-600 @enderror" placeholder="Full name">
                                    @error('data.full_name')<p class="linoge-error">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="linoge-label">Email address</label>
                                    <input type="text" wire:model='data.email' class="linoge-input @error('data.email') border-red-600 @enderror" placeholder="Email address">
                                    @error('data.email')<p class="linoge-error">{{ $message }}</p>@enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="linoge-label">Phone number</label>
                                    <input type="text" wire:model='data.phone' class="linoge-input @error('data.phone') border-red-600 @enderror" placeholder="Phone number">
                                    @error('data.phone')<p class="linoge-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        <div>
                            <h3 class="linoge-sub-title">Shipping Information</h3>
                            <div class="linoge-field-grid">
                                <div>
                                    <label class="linoge-label">Street address</label>
                                    <input wire:model='data.address_line' type="text" class="linoge-input @error('data.address_line') border-red-600 @enderror" placeholder="Address">
                                    @error('data.address_line')<p class="linoge-error">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label class="linoge-label">City / Region / Location search</label>
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
                                        <input type="text" wire:model.live.debounce.500ms='region_selector.keyword' x-on:focus="open = true" x-on:click.outside="open = false" class="linoge-input" placeholder="Type city or kecamatan name...">
                                        <div wire:loading wire:target='region_selector.keyword' class="absolute right-4 top-3.5 animate-spin inline-block size-4 border-2 border-current border-t-transparent text-neutral-900 rounded-full" role="status" aria-label="loading"></div>

                                        @if(count($regionList) > 0)
                                            <ul class="linoge-dropdown" x-show="open" x-cloak>
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
                                            <div class="mt-2 p-2.5 bg-neutral-200/60 border border-neutral-300 text-xs text-neutral-800 font-medium">
                                                Selected location: <strong>{{ data_get($selectedRegion, 'label') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    @error('data.destination_region_code')<p class="linoge-error">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 2: DELIVERY -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Delivery</h2>
                        @error('data.shipping_hash')<p class="linoge-error mb-2">{{ $message }}</p>@enderror
                        <div class="w-full relative flex justify-center my-1">
                            <div wire:loading wire:target='region_selector.region_selected' class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-neutral-900 rounded-full" role="status" aria-label="loading"></div>
                        </div>
                        <div class="space-y-2">
                            @forelse ($this->shipping_methods as $group_name => $shipping_method_groups)
                                <p class="text-xs font-bold uppercase tracking-wider text-neutral-500 mt-3 mb-1">{{ $group_name }}</p>
                                @foreach ($shipping_method_groups as $i => $shipping_method)
                                    <label for="shipping_method_{{ $shipping_method->hash }}" class="linoge-choice">
                                        <span class="flex items-center gap-3">
                                            <input wire:key='{{ $shipping_method->hash }}' wire:model.live='data.shipping_hash' type="radio" value="{{ $shipping_method->hash }}" id="shipping_method_{{ $shipping_method->hash }}">
                                            @if($shipping_method->logo_url)<img src="{{ $shipping_method->logo_url }}" class="h-4 object-contain" alt="{{ $shipping_method->label }}" />@endif
                                            <span class="linoge-choice-title">{{ $shipping_method->label }}</span>
                                        </span>
                                        <span class="linoge-choice-price">{{ $shipping_method->cost_formatted }}</span>
                                    </label>
                                @endforeach
                            @empty
                                <div class="p-3 bg-neutral-200/60 border border-neutral-300 text-xs text-neutral-600 font-medium">
                                    Please enter your Shipping Address above first.
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <!-- SECTION 3: PAYMENT -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Payment</h2>
                        @error('data.payment_method_hash')<p class="linoge-error mb-2">{{ $message }}</p>@enderror
                        <div class="space-y-2">
                            @foreach ($this->payment_methods->toCollection() as $key => $payment_method)
                                <label for="payment_method_{{ $payment_method->hash }}" class="linoge-choice">
                                    <span class="flex items-center gap-3">
                                        <input type="radio" wire:key='payment_method-{{ $payment_method->hash }}' wire:model='payment_method_selector.payment_method_selected' value="{{ $payment_method->hash }}" id="payment_method_{{ $payment_method->hash }}">
                                        <span class="linoge-choice-title">{{ $payment_method->label }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- SIDEBAR: SHOPPING BAG SUMMARY -->
                <aside class="linoge-summary">
                    <div class="linoge-summary-header">
                        <h2 class="linoge-summary-title">Shopping Bag</h2>
                        <span class="linoge-summary-count">({{ $cart->items->toCollection()->sum('quantity') }})</span>
                    </div>

                    <!-- Item list -->
                    <div class="divide-y divide-neutral-300">
                        @foreach ($cart->items as $item)
                            <x-single-product-list :cart_item="$item" />
                        @endforeach
                    </div>

                    <!-- Promocode input -->
                    <div class="linoge-promocode-row">
                        <input type="text" placeholder="Promocode" class="linoge-promocode-input">
                        <button type="button" class="linoge-promocode-btn">APPLY</button>
                    </div>

                    <!-- Breakdown -->
                    <div class="linoge-breakdown">
                        <div class="linoge-row">
                            <span>Sub total</span>
                            <strong>{{ data_get($this->summary, 'sub_total_formatted') }}</strong>
                        </div>
                        <div class="linoge-row">
                            <span>Shipping</span>
                            <strong>{{ data_get($this->summary, 'shipping_total_formatted', 'Free') }}</strong>
                        </div>
                        <div class="linoge-row">
                            <span>Discount</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="linoge-row total">
                            <span>Total:</span>
                            <strong>{{ data_get($this->summary, 'grand_total_formatted') }}</strong>
                        </div>
                    </div>

                    <!-- Primary Action Button -->
                    <button type="button" wire:click='placeAnOrder()' wire:loading.attr='disabled' class="linoge-btn-primary">
                        <span>PAY AND PLACE ORDER</span>
                        <div wire:loading class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"></div>
                    </button>
                </aside>
            </div>
        </div>
    </div>
</div>
