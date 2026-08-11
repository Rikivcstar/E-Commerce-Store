<div>
    <x-layouts.app title="Wishlist">
        <style>
            .wishlist-page {
                max-width: 92rem;
                margin: 0 auto;
                padding: clamp(1rem, 3vw, 2.5rem) clamp(1rem, 3vw, 2.5rem) 4rem;
            }
            .wishlist-title {
                color: #20221b;
                font-family: Finlandica, Inter, sans-serif;
                font-size: clamp(2.2rem, 5vw, 4rem);
                font-weight: 900;
                line-height: .9;
                text-transform: uppercase;
            }
            .wishlist-subtitle {
                margin-top: .6rem;
                color: #8b8f82;
                font-size: .9rem;
                font-weight: 700;
            }
            .wishlist-grid {
                margin-top: 1.75rem;
                display: grid;
                gap: 1.1rem;
                grid-template-columns: repeat(auto-fill, minmax(16rem, 1fr));
            }
            .wish-card {
                position: relative;
                display: block;
                overflow: hidden;
                padding: .6rem;
                border: 1px solid #e5e2d7;
                background: rgba(255,255,255,.9);
                border-radius: 1.3rem;
                color: inherit;
                text-decoration: none;
                transition: transform .25s ease, box-shadow .25s ease;
            }
            .wish-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 24px 48px rgba(32,34,27,.1);
            }
            .wish-media {
                overflow: hidden;
                border-radius: 1rem;
                background: #eff0ea;
                aspect-ratio: 1.08 / 1;
            }
            .wish-media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .7s ease;
            }
            .wish-card:hover .wish-media img {
                transform: scale(1.05);
            }
            .wish-remove {
                position: absolute;
                top: 1.1rem;
                right: 1.1rem;
                z-index: 2;
                background: rgba(255,255,255,.95);
                box-shadow: 0 10px 24px rgba(32,34,27,.14);
            }
            .wish-info {
                padding: .9rem .3rem .45rem;
            }
            .wish-name {
                min-height: 2.35rem;
                color: #20221b;
                font-size: .92rem;
                font-weight: 900;
                line-height: 1.25;
                text-transform: uppercase;
            }
            .wish-row {
                margin-top: .65rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
            }
            .wish-price {
                color: #20221b;
                font-size: .9rem;
                font-weight: 900;
            }
            .wish-empty {
                margin-top: 2rem;
                padding: 2.5rem;
                text-align: center;
                border: 1px dashed #d7cfbf;
                border-radius: 1.3rem;
                color: #8b8f82;
                background: rgba(255,255,255,.6);
            }
            .wish-empty a {
                display: inline-flex;
                margin-top: 1rem;
                padding: .75rem 1.5rem;
                border-radius: 999px;
                background: #4d4634;
                color: #fffaf2;
                font-weight: 900;
                text-decoration: none;
            }
        </style>

        <div class="wishlist-page">
            <h1 class="wishlist-title">Wishlist</h1>
            <p class="wishlist-subtitle">Produk yang Anda simpan untuk dibeli nanti.</p>

            @if ($items->isEmpty())
                <div class="wish-empty">
                    <p>Wishlist Anda masih kosong.</p>
                    <a href="{{ route('product-catalog') }}">Jelajahi Produk</a>
                </div>
            @else
                <div class="wishlist-grid">
                    @foreach ($items as $item)
                        <a class="wish-card" href="{{ route('product', $item->slug) }}">
                            <div class="wish-remove">
                                <livewire:wishlist-remove :product="$item" wire:key="wish-{{ $item->sku }}" />
                            </div>
                            <div class="wish-media">
                                <img src="{{ $item->cover_url }}" alt="{{ $item->name }}" loading="lazy">
                            </div>
                            <div class="wish-info">
                                <h3 class="wish-name">{{ $item->name }}</h3>
                                <div class="wish-row">
                                    <p class="wish-price">{{ $item->price_formatted }}</p>
                                    <span class="text-xs font-black text-zinc-400">{{ $item->sku }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </x-layouts.app>
</div>