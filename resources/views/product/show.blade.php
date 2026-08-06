<x-layouts.app>
    <style>
        .product-page { background: #f7f2e8; padding: 2rem clamp(1rem, 3vw, 2.5rem) 4rem; }
        .product-shell { max-width: 92rem; margin: 0 auto; }
        .product-kicker { color: #8b7659; font-size: .75rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .product-grid { display: grid; gap: 1.5rem; align-items: start; }
        .product-media-card, .product-info-card, .product-desc-card { border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 1.6rem; box-shadow: 0 18px 45px rgba(79, 68, 48, .08); overflow: hidden; }
        .product-main-image { width: 100%; aspect-ratio: 1.18 / 1; object-fit: cover; background: #efe3cf; display: block; }
        .product-thumbs { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: .75rem; padding: .75rem; background: #f3eadc; border-top: 1px solid #d7c7ad; }
        .product-thumbs img { width: 100%; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 1rem; border: 1px solid #d7c7ad; background: #fffaf2; }
        .product-info-card { padding: clamp(1.25rem, 3vw, 2rem); position: sticky; top: 6rem; }
        .product-title { margin-top: .55rem; color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: clamp(2.4rem, 5vw, 4.8rem); font-weight: 900; line-height: .9; letter-spacing: 0; text-transform: uppercase; }
        .product-short { margin-top: 1rem; color: #6c5d48; font-size: 1rem; line-height: 1.7; }
        .product-price { display: block; margin-top: 1.4rem; color: #4d4634; font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900; }
        .product-divider { height: 1px; background: #d7c7ad; margin: 1.6rem 0; }
        .product-desc-card { margin-top: 1.5rem; padding: clamp(1.25rem, 3vw, 2rem); }
        .product-desc-card h2 { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 1.75rem; font-weight: 900; text-transform: uppercase; }
        .product-desc { margin-top: 1rem; color: #5d523f; font-size: 1rem; line-height: 1.8; }
        @media (min-width: 980px) { .product-grid { grid-template-columns: minmax(0, 1.35fr) minmax(22rem, .65fr); } }
    </style>

    <div class="product-page">
        <div class="product-shell">
            <div class="product-grid">
                <div>
                    <div class="product-media-card" data-aos="fade-right">
                        <img src="{{ $product->cover_url }}" alt="{{ $product->name }}" class="product-main-image">
                        @if($product->gallery && count($product->gallery) > 0)
                            <div class="product-thumbs">
                                @foreach ($product->gallery as $key => $image)
                                    <img src="{{ $image }}" alt="image-{{ $key }}">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="product-desc-card">
                        <p class="product-kicker">Product notes</p>
                        <h2>Description</h2>
                        <div class="product-desc prose max-w-none">
                            {!! Str::markDown($product->description) !!}
                        </div>
                    </div>
                </div>

                <aside class="product-info-card" data-aos="fade-left">
                    <p class="product-kicker">{{ $product->sku }}</p>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <p class="product-short">{{ $product->short_desc }}</p>
                    <span class="product-price">{{ $product->price_formatted }}</span>
                    <div class="product-divider"></div>
                    <livewire:add-to-card :product="$product" />
                    <div class="product-divider"></div>
                    <div class="grid gap-3 text-sm font-bold text-[#5d523f]">
                        <span>Original curated item</span>
                        <span>Checkout cepat dan aman</span>
                        <span>Support setelah pembelian</span>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-layouts.app>
