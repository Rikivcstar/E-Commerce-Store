<x-layouts.app>
    <style>
        .product-page {
            background: #f7f7f2;
            padding: clamp(1rem, 2vw, 1.75rem) clamp(1rem, 3vw, 2.5rem) 4rem;
        }
        .product-shell {
            max-width: 92rem;
            margin: 0 auto;
        }
        .product-crumbs {
            display: flex;
            align-items: center;
            gap: .55rem;
            margin-bottom: 1.15rem;
            color: #8b8f82;
            font-size: .78rem;
            font-weight: 800;
        }
        .product-crumbs a {
            color: #555a42;
            text-decoration: none;
        }
        .product-layout {
            display: grid;
            gap: 1.2rem;
            align-items: start;
        }
        .product-gallery {
            display: grid;
            gap: .85rem;
        }
        .product-main-card,
        .product-info-card,
        .product-detail-card,
        .review-card,
        .recommend-card {
            border: 1px solid #e5e2d7;
            background: rgba(255,255,255,.88);
            border-radius: 1.45rem;
            box-shadow: 0 18px 45px rgba(32,34,27,.06);
        }
        .product-main-card {
            position: relative;
            overflow: hidden;
            background: #eef0ea;
        }
        .product-main-image {
            display: block;
            width: 100%;
            min-height: 26rem;
            max-height: 45rem;
            aspect-ratio: 1 / .84;
            object-fit: cover;
        }
        .product-gallery-track {
            position: absolute;
            left: 50%;
            bottom: 1rem;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .65rem;
            width: min(30rem, calc(100% - 2rem));
            transform: translateX(-50%);
        }
        .product-thumb {
            overflow: hidden;
            border: 3px solid rgba(255,255,255,.9);
            border-radius: .95rem;
            background: #f1f2ec;
            box-shadow: 0 12px 28px rgba(32,34,27,.13);
        }
        .product-thumb img {
            width: 100%;
            aspect-ratio: 1.45 / 1;
            object-fit: cover;
            display: block;
        }
        .product-info-card {
            padding: clamp(1.25rem, 2.6vw, 2rem);
            position: sticky;
            top: 6rem;
        }
        .product-pill {
            display: inline-flex;
            align-items: center;
            border: 1px solid #e5e2d7;
            border-radius: 999px;
            background: #fff;
            padding: .45rem .75rem;
            color: #686d55;
            font-size: .68rem;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .product-sku {
            margin-top: 1.35rem;
            color: #777c62;
            font-size: .72rem;
            font-weight: 900;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        .product-title {
            margin-top: .45rem;
            color: #20221b;
            font-family: Finlandica, Inter, sans-serif;
            font-size: clamp(2.7rem, 5.4vw, 5.45rem);
            font-weight: 900;
            line-height: .82;
            letter-spacing: 0;
            text-transform: uppercase;
            overflow-wrap: anywhere;
        }
        .product-short {
            margin-top: 1rem;
            color: #74786b;
            font-size: 1rem;
            line-height: 1.65;
        }
        .product-price {
            display: block;
            margin-top: 1.45rem;
            color: #4f4938;
            font-size: clamp(2rem, 3.6vw, 3.4rem);
            font-weight: 900;
            line-height: 1;
            overflow-wrap: anywhere;
        }
        .product-divider {
            height: 1px;
            margin: 1.45rem 0;
            background: #e0d7c6;
        }
        .product-benefits {
            display: grid;
            gap: .85rem;
            color: #5e5948;
            font-size: .9rem;
            font-weight: 850;
        }
        .product-benefits span {
            display: flex;
            align-items: center;
            gap: .65rem;
        }
        .product-benefits svg {
            width: 1rem;
            height: 1rem;
            color: #777c62;
        }
        .product-info-stack {
            margin-top: 1.15rem;
            display: grid;
            gap: .85rem;
        }
        .product-detail-card {
            padding: 1rem;
        }
        .product-detail-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            color: #20221b;
            font-size: .92rem;
            font-weight: 900;
        }
        .product-detail-card p,
        .product-detail-card .prose {
            margin-top: .75rem;
            color: #74786b;
            font-size: .86rem;
            line-height: 1.65;
        }
        .shipping-grid {
            margin-top: .9rem;
            display: grid;
            gap: .8rem;
        }
        .shipping-item {
            display: flex;
            gap: .7rem;
            align-items: center;
            border-radius: .9rem;
            background: #f6f6f0;
            padding: .75rem;
        }
        .shipping-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            flex: 0 0 auto;
            border-radius: 999px;
            background: #20221b;
            color: #fff;
        }
        .shipping-icon svg {
            width: .95rem;
            height: .95rem;
        }
        .shipping-label {
            display: block;
            color: #9a9d91;
            font-size: .66rem;
            font-weight: 900;
            text-transform: uppercase;
        }
        .shipping-value {
            display: block;
            margin-top: .15rem;
            color: #20221b;
            font-size: .8rem;
            font-weight: 900;
        }
        .below-grid {
            margin-top: 2.5rem;
            display: grid;
            gap: 1.2rem;
        }
        .review-section-title {
            margin-bottom: 1rem;
            color: #20221b;
            font-size: 1.15rem;
            font-weight: 900;
        }
        .rating-panel {
            display: grid;
            gap: 1rem;
            align-items: center;
        }
        .rating-score {
            color: #111;
            font-size: clamp(4rem, 9vw, 8rem);
            font-weight: 500;
            line-height: .9;
            letter-spacing: 0;
        }
        .rating-score small {
            color: #8b8f82;
            font-size: 1.1rem;
        }
        .rating-caption {
            margin-top: .55rem;
            color: #8b8f82;
            font-size: .85rem;
            font-weight: 800;
        }
        .rating-bars {
            display: grid;
            gap: .55rem;
        }
        .rating-bar {
            display: grid;
            grid-template-columns: 1.7rem 1fr;
            gap: .65rem;
            align-items: center;
            color: #777c62;
            font-size: .8rem;
            font-weight: 900;
        }
        .bar-track {
            height: .42rem;
            overflow: hidden;
            border-radius: 999px;
            background: #ecede6;
        }
        .bar-fill {
            height: 100%;
            border-radius: inherit;
            background: #20221b;
        }
        .review-card {
            padding: 1rem;
        }
        .review-head {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 1rem;
        }
        .review-name {
            color: #20221b;
            font-size: .95rem;
            font-weight: 900;
        }
        .review-date {
            color: #9a9d91;
            font-size: .74rem;
            font-weight: 800;
        }
        .review-stars {
            margin-top: .25rem;
            color: #c9a24b;
            letter-spacing: .12em;
        }
        .review-text {
            margin-top: .85rem;
            color: #74786b;
            font-size: .86rem;
            line-height: 1.65;
        }
        .recommend-section {
            margin-top: 3.5rem;
        }
        .recommend-title {
            color: #20221b;
            font-family: Finlandica, Inter, sans-serif;
            font-size: clamp(2.4rem, 5vw, 4.2rem);
            font-weight: 900;
            line-height: .9;
            text-align: center;
            text-transform: uppercase;
        }
        .recommend-grid {
            margin-top: 1.35rem;
            display: grid;
            gap: 1rem;
        }
        .recommend-card {
            display: block;
            overflow: hidden;
            padding: .55rem;
            color: inherit;
            text-decoration: none;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .recommend-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px rgba(32,34,27,.1);
        }
        .recommend-media {
            overflow: hidden;
            border-radius: 1rem;
            background: #eff0ea;
            aspect-ratio: 1.08 / 1;
        }
        .recommend-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .7s ease;
        }
        .recommend-card:hover img {
            transform: scale(1.05);
        }
        .recommend-info {
            padding: .9rem .3rem .45rem;
        }
        .recommend-name {
            min-height: 2.35rem;
            color: #20221b;
            font-size: .92rem;
            font-weight: 900;
            line-height: 1.25;
            text-transform: uppercase;
        }
        .recommend-row {
            margin-top: .65rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
        }
        .recommend-price {
            color: #20221b;
            font-size: .9rem;
            font-weight: 900;
        }
        .recommend-rating {
            color: #c9a24b;
            font-size: .8rem;
            letter-spacing: .08em;
        }
        @media (min-width: 640px) {
            .shipping-grid,
            .recommend-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .rating-panel { grid-template-columns: 14rem 1fr; }
        }
        @media (min-width: 980px) {
            .product-layout { grid-template-columns: minmax(0, 1.22fr) minmax(24rem, .78fr); }
            .below-grid { grid-template-columns: minmax(0, .9fr) minmax(22rem, 1.1fr); }
            .recommend-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }
        @media (max-width: 760px) {
            .product-info-card { position: static; }
            .product-main-image { min-height: 21rem; }
            .product-gallery-track { position: static; width: 100%; transform: none; padding: .75rem; background: #fff; }
            .product-thumb { box-shadow: none; }
        }
    </style>

    <div class="product-page">
        <div class="product-shell">
            <nav class="product-crumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('product-catalog') }}">Catalog</a>
                <span aria-hidden="true">/</span>
                <span>{{ $product->name }}</span>
            </nav>

            <div class="product-layout">
                <section class="product-gallery" aria-label="Product gallery">
                    <div class="product-main-card" data-aos="fade-right">
                        <img src="{{ $product->cover_url }}" alt="{{ $product->name }}" class="product-main-image">

                        <div class="product-gallery-track">
                            <div class="product-thumb">
                                <img src="{{ $product->cover_url }}" alt="{{ $product->name }} thumbnail">
                            </div>
                            @foreach (collect(is_array($product->gallery) ? $product->gallery : [])->take(2) as $key => $image)
                                <div class="product-thumb">
                                    <img src="{{ $image }}" alt="{{ $product->name }} gallery {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <aside class="product-info-card" data-aos="fade-left">
                    @if ($product->short_desc)
                        <span class="product-pill">{{ $product->short_desc }}</span>
                    @endif
                    <p class="product-sku">{{ $product->sku }}</p>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <span class="product-price">{{ $product->price_formatted }}</span>

                    <div class="product-divider"></div>
                    <livewire:add-to-card :product="$product" />
                    <div class="product-divider"></div>

                    <div class="product-benefits">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>Original curated item</span>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>Checkout cepat dan aman</span>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>Support setelah pembelian</span>
                    </div>

                    <div class="product-info-stack">
                        <div class="product-detail-card">
                            <div class="product-detail-head">
                                <span>Description & Fit</span>
                                <span aria-hidden="true">+</span>
                            </div>
                            <div class="prose max-w-none">
                                @if ($product->description)
                                    {!! Str::markDown($product->description) !!}
                                @else
                                    <p>Produk pilihan dengan detail yang dikurasi untuk penggunaan harian.</p>
                                @endif
                            </div>
                        </div>

                        <div class="product-detail-card">
                            <div class="product-detail-head">
                                <span>Shipping</span>
                                <span aria-hidden="true">+</span>
                            </div>
                            <div class="shipping-grid">
                                <div class="shipping-item">
                                    <span class="shipping-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/></svg></span>
                                    <span><span class="shipping-label">Package</span><span class="shipping-value">Regular Package</span></span>
                                </div>
                                <div class="shipping-item">
                                    <span class="shipping-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg></span>
                                    <span><span class="shipping-label">Delivery</span><span class="shipping-value">3-5 Working Days</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <section aria-label="Product reviews">
                <h2 class="review-section-title">Rating &amp; Reviews</h2>
                <div class="below-grid">
                    <div class="rating-panel">
                        <div>
                            <div class="rating-score">4.5<small>/5</small></div>
                            <p class="rating-caption">Based on customer reviews</p>
                        </div>
                        <div class="rating-bars">
                            @foreach ([92, 76, 48, 24, 10] as $index => $width)
                                <div class="rating-bar">
                                    <span>{{ 5 - $index }} &#9733;</span>
                                    <span class="bar-track"><span class="bar-fill" style="width: {{ $width }}%"></span></span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <article class="review-card">
                        <div class="review-head">
                            <div>
                                <p class="review-name">Nexora Customer</p>
                                <p class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                            </div>
                            <span class="review-date">Verified review</span>
                        </div>
                        <p class="review-text">Produk terasa clean, rapi, dan mudah dipadukan. Detail belanja juga jelas sehingga proses checkout terasa lebih nyaman.</p>
                    </article>
                </div>
            </section>

            @if ($recommendations->count())
                <section class="recommend-section" aria-label="Recommended products">
                    <h2 class="recommend-title">You might also like</h2>
                    <div class="recommend-grid">
                        @foreach ($recommendations as $item)
                            <a class="recommend-card" href="{{ route('product', $item->slug) }}">
                                <div class="recommend-media">
                                    <img src="{{ $item->cover_url }}" alt="{{ $item->name }}">
                                </div>
                                <div class="recommend-info">
                                    <h3 class="recommend-name">{{ $item->name }}</h3>
                                    <div class="recommend-row">
                                        <p class="recommend-price">{{ $item->price_formatted }}</p>
                                        <span class="recommend-rating">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-layouts.app>