<div>
    <style>
        .linoge-cart-page {
            background-color: #eaeae8;
            color: #111111;
            padding: 2.5rem clamp(1rem, 4vw, 3.5rem) 5rem;
            min-height: 80vh;
        }
        .linoge-cart-shell {
            max-width: 92rem;
            margin: 0 auto;
        }
        .linoge-cart-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid #d4d4d0;
            padding-bottom: 1.5rem;
        }
        .linoge-cart-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-weight: 900;
            font-size: clamp(2.5rem, 7vw, 5.5rem);
            line-height: 0.88;
            letter-spacing: -0.03em;
            text-transform: uppercase;
            color: #111111;
        }
        .linoge-cart-count {
            font-size: 0.85rem;
            font-weight: 700;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .linoge-cart-grid {
            display: grid;
            gap: 2.5rem;
            align-items: start;
        }
        .linoge-cart-item {
            display: grid;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid #d4d4d0;
        }
        .linoge-cart-item:first-child {
            padding-top: 0;
        }
        .linoge-cart-img-wrapper {
            width: 100%;
            aspect-ratio: 3 / 4;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            overflow: hidden;
        }
        .linoge-cart-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .linoge-cart-img:hover {
            transform: scale(1.03);
        }
        .linoge-cart-item-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #111111;
            letter-spacing: -0.01em;
        }
        .linoge-cart-item-desc {
            font-size: 0.8rem;
            color: #666666;
            margin-top: 0.25rem;
            line-height: 1.4;
        }
        .linoge-cart-price {
            font-size: 1rem;
            font-weight: 800;
            color: #111111;
            white-space: nowrap;
        }
        .linoge-cart-summary {
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            padding: 1.75rem;
            position: sticky;
            top: 6rem;
        }
        .linoge-cart-summary-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            text-transform: uppercase;
            color: #111111;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid #d4d4d0;
            padding-bottom: 0.75rem;
        }
        .linoge-cart-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #555555;
            padding: 0.6rem 0;
        }
        .linoge-cart-summary-row strong {
            color: #111111;
            font-weight: 700;
        }
        .linoge-cart-summary-total {
            border-top: 1px solid #111111;
            margin-top: 0.75rem;
            padding-top: 1rem;
            font-size: 1rem;
            font-weight: 900;
            color: #111111;
        }
        .linoge-cart-summary-total strong {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
        }
        .linoge-cart-btn-checkout {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1.1rem;
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
        .linoge-cart-btn-checkout:hover {
            background-color: #000000;
        }
        .linoge-cart-btn-continue {
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.9rem;
            background-color: transparent;
            color: #111111;
            border: 1px solid #111111;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .linoge-cart-btn-continue:hover {
            background-color: #111111;
            color: #ffffff;
        }
        .linoge-empty-bag {
            padding: 5rem 1rem;
            text-align: center;
        }
        .linoge-empty-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #111111;
        }
        @media (min-width: 640px) {
            .linoge-cart-item {
                grid-template-columns: 8rem minmax(0, 1fr);
            }
        }
        @media (min-width: 980px) {
            .linoge-cart-grid {
                grid-template-columns: minmax(0, 1fr) 24rem;
            }
        }
    </style>

    <div class="linoge-cart-page">
        <div class="linoge-cart-shell">
            <!-- BREADCRUMBS -->
            <nav class="flex items-center gap-2 text-xs text-neutral-500 font-semibold uppercase tracking-wider mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-neutral-900 transition">{{ __('Home') }}</a>
                <span>/</span>
                <span class="text-neutral-900">{{ __('Shopping Bag') }}</span>
            </nav>

            <!-- HEADER -->
            <div class="linoge-cart-header">
                <h1 class="linoge-cart-title">SHOPPING BAG</h1>
                <span class="linoge-cart-count">{{ $items->sum('quantity') }} ITEM{{ $items->sum('quantity') === 1 ? '' : 'S' }}</span>
            </div>

            <div class="linoge-cart-grid">
                <!-- CART ITEMS LIST -->
                <section aria-label="Cart items">
                    @forelse ($items as $item)
                        @php($product = $item->product())
                        <article class="linoge-cart-item">
                            <!-- Product Image -->
                            <a class="linoge-cart-img-wrapper" href="{{ route('product', $product->slug) }}">
                                <img class="linoge-cart-img" src="{{ $product->cover_url }}" alt="{{ $product->name }}">
                            </a>

                            <!-- Product Info & Actions -->
                            <div class="flex flex-col justify-between py-1">
                                <div>
                                    <div class="flex justify-between items-start gap-4">
                                        <div>
                                            <a href="{{ route('product', $product->slug) }}" class="hover:underline">
                                                <h2 class="linoge-cart-item-title">{{ $product->name }}</h2>
                                            </a>
                                            @if($product->short_desc)
                                                <p class="linoge-cart-item-desc">{{ $product->short_desc }}</p>
                                            @endif
                                        </div>
                                        <p class="linoge-cart-price">{{ $product->price_formatted }}</p>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-neutral-300/60">
                                    <div class="flex items-center gap-3">
                                        <livewire:add-to-card wire:key="cart-update-{{ $item->sku }}" :product="$product" label="Update" />
                                    </div>
                                    <div>
                                        <livewire:cart-remove wire:key="remove-{{ $item->sku }}" :product="$product" />
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="linoge-empty-bag">
                            <h2 class="linoge-empty-title">{{ __('YOUR BAG IS EMPTY') }}</h2>
                            <p class="mt-3 text-sm text-neutral-600 max-w-md mx-auto">{{ __('Explore our curated collections and add your favorite items to your shopping bag.') }}</p>
                            <div class="mt-8 max-w-xs mx-auto">
                                <a href="{{ route('product-catalog') }}" class="linoge-cart-btn-checkout">{{ __('EXPLORE CATALOG') }}</a>
                            </div>
                        </div>
                    @endforelse
                </section>

                <!-- ORDER SUMMARY SIDEBAR -->
                @if(count($items) > 0)
                    <aside class="linoge-cart-summary" aria-label="Order summary">
                        <h2 class="linoge-cart-summary-title">ORDER SUMMARY</h2>
                        <div class="space-y-1">
                            <div class="linoge-cart-summary-row">
                                <span>{{ __('Subtotal') }}</span>
                                <strong>{{ $subTotal }}</strong>
                            </div>
                            <div class="linoge-cart-summary-row">
                                <span>{{ __('Shipping') }}</span>
                                <strong>{{ __('Calculated at checkout') }}</strong>
                            </div>
                            <div class="linoge-cart-summary-row linoge-cart-summary-total">
                                <span>{{ __('Estimated Total') }}</span>
                                <strong>{{ $total }}</strong>
                            </div>
                        </div>

                        <button type="button" wire:click="checkout" wire:loading.attr="disabled" class="linoge-cart-btn-checkout">
                            <span>{{ __('PROCEED TO CHECKOUT') }}</span>
                            <div wire:loading class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-white rounded-full ml-1" role="status" aria-label="loading"></div>
                        </button>

                        <a class="linoge-cart-btn-continue" href="{{ route('product-catalog') }}">{{ __('CONTINUE SHOPPING') }}</a>
                    </aside>
                @endif
            </div>
        </div>
    </div>
</div>