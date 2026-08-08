<div class="bg-[#f7f7f2] text-[#20221b]">
    <section class="nexora-struct-hero-shell">
        <style>
            .nexora-struct-hero-shell {
                padding: 1rem clamp(0.75rem, 2vw, 2rem) 2rem;
                background: #f7f2e8;
            }
            .nexora-struct-hero {
                position: relative;
                min-height: calc(100vh - 5.5rem);
                max-width: 92rem;
                margin: 0 auto;
                overflow: hidden;
                border-radius: 2rem;
                background: linear-gradient(180deg, #f9f4ea 0%, #efe3cf 100%);
                border: 1px solid #d7c7ad;
                box-shadow: 0 18px 45px rgba(79, 68, 48, 0.08);
            }
            .nexora-struct-topline {
                position: absolute;
                inset: 2rem 3rem auto;
                z-index: 4;
                display: flex;
                justify-content: space-between;
                gap: 1rem;
                color: #665842;
                font-size: 0.72rem;
                font-weight: 900;
                letter-spacing: 0.12em;
                text-transform: uppercase;
            }
            .nexora-struct-word {
                position: absolute;
                left: 50%;
                top: 48%;
                z-index: 1;
                transform: translate(-50%, -50%);
                width: 100%;
                text-align: center;
                font-family: Finlandica, Inter, sans-serif;
                font-size: clamp(5rem, 17vw, 17rem);
                font-weight: 900;
                line-height: 0.75;
                letter-spacing: 0;
                color: #11100d;
                text-transform: uppercase;
                white-space: nowrap;
            }
            .nexora-struct-image {
                position: absolute;
                left: 50%;
                top: 48%;
                z-index: 3;
                width: min(30rem, 40vw);
                transform: translate(-50%, -50%);
                filter:
                    drop-shadow(0 30px 22px rgba(63, 51, 34, 0.22))
                    drop-shadow(0 8px 18px rgba(35, 29, 21, 0.12));
            }
            .nexora-model-shadow {
                position: absolute;
                left: 50%;
                bottom: 7.1rem;
                z-index: 2;
                width: min(20rem, 34vw);
                height: 3.2rem;
                transform: translateX(-50%);
                border-radius: 999px;
                background: radial-gradient(ellipse, rgba(59, 47, 31, .28) 0%, rgba(84, 68, 44, .12) 44%, rgba(84, 68, 44, 0) 72%);
                filter: blur(8px);
                pointer-events: none;
            }
            .nexora-struct-script {
                position: absolute;
                left: 50%;
                top: 48%;
                z-index: 5;
                transform: translate(-50%, -50%) rotate(-4deg);
                font-family: Georgia, serif;
                font-size: clamp(4.2rem, 11vw, 11rem);
                font-style: italic;
                font-weight: 700;
                line-height: 1;
                color: #8f744d;
                opacity: 0.92;
                pointer-events: none;
                white-space: nowrap;
            }
            .nexora-struct-copy-left,
            .nexora-struct-copy-right {
                position: absolute;
                z-index: 6;
                bottom: 9.5rem;
                max-width: 14rem;
                color: #5d523f;
                font-size: 0.78rem;
                font-weight: 900;
                letter-spacing: 0.1em;
                line-height: 1.35;
                text-transform: uppercase;
            }
            .nexora-struct-copy-left { left: 3.2rem; }
            .nexora-struct-copy-right { right: 3.2rem; text-align: right; }
            .nexora-struct-actions {
                position: absolute;
                left: 50%;
                bottom: 4.2rem;
                z-index: 7;
                display: flex;
                gap: 0.75rem;
                transform: translateX(-50%);
            }
            .nexora-struct-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 9.5rem;
                height: 2.8rem;
                border-radius: 0;
                border: 1px solid #191713;
                font-size: 0.75rem;
                font-weight: 900;
                text-transform: uppercase;
                text-decoration: none;
                transition: transform .2s ease, background .2s ease, color .2s ease;
            }
            .nexora-struct-btn.primary { background: #11100d; color: #fffaf2; }
            .nexora-struct-btn.secondary { background: rgba(255, 250, 242, 0.62); color: #11100d; }
            .nexora-struct-btn:hover { transform: translateY(-2px); }
            .nexora-struct-floor {
                position: absolute;
                inset: auto 0 0;
                z-index: 2;
                height: 29%;
                background: linear-gradient(180deg, rgba(222, 209, 187, 0) 0%, rgba(213, 198, 172, .74) 100%);
                border-top: 1px solid rgba(151, 127, 89, .18);
            }
            @media (max-width: 900px) {
                .nexora-struct-topline { inset: 1.4rem 1.4rem auto; }
                .nexora-struct-topline span:last-child { display: none; }
                .nexora-struct-word { top: 42%; font-size: clamp(4rem, 24vw, 9rem); }
                .nexora-struct-image { top: 45%; width: min(22rem, 70vw); }
                .nexora-model-shadow { bottom: 7.3rem; width: min(15rem, 48vw); height: 2.7rem; }
                .nexora-struct-script { top: 58%; font-size: clamp(3.4rem, 17vw, 7rem); }
                .nexora-struct-copy-left,
                .nexora-struct-copy-right {
                    bottom: 8.7rem;
                    max-width: 12rem;
                    font-size: .68rem;
                }
                .nexora-struct-copy-left { left: 1.4rem; }
                .nexora-struct-copy-right { right: 1.4rem; }
            }
            @media (max-width: 640px) {
                .nexora-struct-hero { min-height: 42rem; border-radius: 1.4rem; }
                .nexora-struct-word { top: 35%; font-size: 23vw; }
                .nexora-struct-image { top: 41%; width: min(18.5rem, 76vw); }
                .nexora-model-shadow { bottom: 6.1rem; width: min(13rem, 58vw); height: 2.3rem; }
                .nexora-struct-script { top: 55%; font-size: 20vw; }
                .nexora-struct-copy-left,
                .nexora-struct-copy-right { display: none; }
                .nexora-struct-actions { bottom: 2.2rem; flex-direction: column; width: calc(100% - 2rem); }
                .nexora-struct-btn { width: 100%; }
            }
        </style>

        <div class="nexora-struct-hero">
            <div class="nexora-struct-topline">
                <span>Global shipping&nbsp;&nbsp;|&nbsp;&nbsp;Curated collections</span>
                <span>New curation 2026</span>
            </div>

            <div class="nexora-struct-word">NEXORA</div>
            <div class="nexora-struct-floor"></div>
            <div class="nexora-model-shadow" aria-hidden="true"></div>
            <img class="nexora-struct-image" src="{{ asset('images/hero-outfit-women.png') }}" alt="Model wanita berambut panjang memakai outfit netral">

            <div class="nexora-struct-script">curated</div>
            <div class="nexora-struct-copy-left">Forms that define your daily style.</div>
            <div class="nexora-struct-copy-right">Objects for simple, premium shopping.</div>

            <div class="nexora-struct-actions">
                <a class="nexora-struct-btn primary" href="{{ route('product-catalog') }}">Shop now</a>
                <a class="nexora-struct-btn secondary" href="#best-sellers">Explore collection</a>
            </div>
        </div>
</section>

    <section class="px-3 pt-14 pb-2 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem]">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">Belanja berdasarkan kategori</p>
                    <h2 class="mt-2 font-display text-3xl font-black uppercase text-[#20221b]">Lanjutkan belanja</h2>
                </div>
                <a href="{{ route('product-catalog') }}" class="group hidden items-center gap-2 text-sm font-bold text-[#555a42] hover:text-[#20221b] sm:inline-flex">
                    Semua kategori
                    <svg class="size-4 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-8 sm:gap-x-8 lg:justify-between">
                @foreach ($categories as $category)
                    @php $catCover = $category->products()->first()?->getFirstMediaUrl('cover'); @endphp
                    <a href="{{ route('product-catalog', ['selectCategory' => [$category->id]]) }}" class="group flex w-28 flex-col items-center sm:w-32" title="{{ $category->name }}">
                        <span class="relative block aspect-square w-full overflow-hidden rounded-full bg-[#e9e6dc] shadow-sm ring-1 ring-black/5 transition duration-300 group-hover:-translate-y-1.5 group-hover:shadow-lg group-hover:shadow-[#555a42]/15 group-hover:ring-[#c9c3b2]">
                            @if ($catCover)
                                <img class="absolute inset-0 size-full object-cover transition duration-500 group-hover:scale-110" src="{{ $catCover }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <span class="absolute inset-0 flex items-center justify-center text-[#9a9d87]">
                                    <svg class="size-9" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 3h18v18H3ZM3 9h18M9 3v18" />
                                    </svg>
                                </span>
                            @endif
                            <span class="pointer-events-none absolute inset-0 rounded-full bg-gradient-to-tr from-black/25 via-transparent to-white/25 mix-blend-multiply"></span>
                        </span>
                        <span class="mt-4 text-center text-sm font-black uppercase leading-tight text-[#20221b] transition-colors group-hover:text-[#551a1a]">{{ $category->name }}</span>
                        <span class="mt-1 text-[11px] font-bold uppercase tracking-[0.08em] text-[#8c9082]">{{ $category->products_count }} produk</span>
                    </a>
                @endforeach

                <a href="{{ route('product-catalog') }}" class="group flex w-28 flex-col items-center sm:w-32" title="Semua produk">
                    <span class="relative flex aspect-square w-full items-center justify-center rounded-full border border-dashed border-[#c5cabc] bg-transparent text-[#777c62] transition duration-300 group-hover:-translate-y-1.5 group-hover:border-[#555a42] group-hover:bg-[#eef0e7] group-hover:text-[#20221b]">
                        <svg class="size-10" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" /><path d="M5 12h14" />
                        </svg>
                    </span>
                    <span class="mt-4 text-center text-sm font-black uppercase leading-tight text-[#20221b] transition-colors group-hover:text-[#555a42]">Semua</span>
                    <span class="mt-1 text-[11px] font-bold uppercase tracking-[0.08em] text-[#8c9082]">Lihat semua</span>
                </a>
            </div>
        </div>
    </section>

    <section class="px-3 py-4 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem]">
            <div class="flex flex-col gap-3 rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-black/5 lg:flex-row lg:items-center">
                <label class="relative flex min-w-0 flex-1 items-center">
                    <svg class="pointer-events-none absolute left-4 size-5 text-[#8c9082]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21 21-4.34-4.34" /><circle cx="11" cy="11" r="8" />
                    </svg>
                    <input type="text" aria-label="Cari produk" placeholder="Cari koleksi, kategori, atau produk favorit..."
                        class="h-13 w-full rounded-full border-0 bg-[#f2f3ed] pl-12 pr-4 text-sm text-[#20221b] placeholder:text-[#8c9082] focus:ring-2 focus:ring-[#777c62]/30">
                </label>
<div class="flex gap-2 overflow-x-auto scrollbar-hide">
                    <a href="{{ route('product-catalog') }}" class="inline-flex h-11 shrink-0 items-center rounded-full bg-[#551a1a] px-5 text-xs font-bold text-white transition hover:bg-[#3f4331]">
                        {{ __('All') }}
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('product-catalog', ['selectCategory' => [$category->id]]) }}" class="inline-flex h-11 shrink-0 items-center rounded-full bg-[#f2f3ed] px-5 text-xs font-bold text-[#555a42] transition hover:bg-[#555a42] hover:text-white">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="best-sellers" class="px-3 py-8 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem]">
            <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">Hits penjualan</p>
                    <h2 class="mt-2 font-display text-3xl font-black uppercase text-[#20221b]">Produk pilihan</h2>
                </div>
                <a href="{{ route('product-catalog') }}" class="hidden items-center gap-2 text-sm font-bold text-[#555a42] hover:text-[#20221b] sm:inline-flex">
                    Semua produk
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @foreach ($feature_products as $product)
                    <x-single-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

<section class="px-3 py-6 sm:px-5 lg:px-8">
        <div class="mx-auto grid max-w-[92rem] gap-4 lg:grid-cols-2">
            @foreach ($categories as $category)
                <a href="{{ route('product-catalog', ['selectCategory' => [$category->id]]) }}" class="group relative min-h-64 overflow-hidden rounded-[1.5rem] bg-[#e6e8de] p-6 shadow-sm">
                    @php $cover = $category->products()->first()?->getFirstMediaUrl('cover'); @endphp
                    @if ($cover)
                        <img class="absolute inset-y-0 right-0 h-full w-2/3 object-cover transition duration-700 group-hover:scale-105" src="{{ $cover }}" alt="{{ $category->name }}">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-[#f3f4ee] via-[#f3f4ee]/80 to-transparent"></div>
                    <div class="relative max-w-xs">
                        <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">{{ $category->products_count }} produk</p>
                        <h3 class="mt-2 font-display text-3xl font-black uppercase text-[#20221b]">{{ $category->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-[#65685c]">{{ $category->description ?? 'Jelajahi koleksi pilihan produk terkurasi.' }}</p>
                        <span class="mt-8 inline-flex items-center gap-2 text-sm font-bold text-[#555a42]">Lihat koleksi <span aria-hidden="true">-&gt;</span></span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="px-3 py-8 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem]">
            <div class="mb-5">
                <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">Baru masuk</p>
                <h2 class="mt-2 font-display text-3xl font-black uppercase text-[#20221b]">New arrivals</h2>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @foreach ($latest_products as $product)
                    <x-single-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-3 py-6 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem]">
            <h2 class="mb-5 font-display text-2xl font-black uppercase text-[#20221b]">Teknologi untuk gerakmu</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-6">
                @foreach ([
                    ['Foam ringan', 'Bantalan empuk untuk ritme panjang'],
                    ['Flex motion', 'Lekukan mengikuti gerak natural'],
                    ['Grip control', 'Tapak stabil di banyak permukaan'],
                    ['Breath tech', 'Sirkulasi udara tetap nyaman'],
                    ['Heel support', 'Tumit lebih mantap saat melangkah'],
                    ['Eco material', 'Pilihan material lebih sadar pakai'],
                ] as [$title, $desc])
                    <div class="rounded-[1.25rem] bg-white p-5 text-center shadow-sm ring-1 ring-black/5">
                        <div class="mx-auto flex size-12 items-center justify-center rounded-2xl bg-[#eef0e7] text-[#555a42]">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 3h12l2 6-8 12L4 9Z" /><path d="M11 3 8 9l4 12 4-12-3-6" /><path d="M4 9h16" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-sm font-black uppercase text-[#20221b]">{{ $title }}</h3>
                        <p class="mt-2 text-xs leading-5 text-[#74786b]">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-3 pb-14 pt-6 sm:px-5 lg:px-8">
        <div class="mx-auto max-w-[92rem] overflow-hidden rounded-[1.5rem] bg-[#dfe2d2] p-6 sm:p-8">
            <div class="grid items-center gap-6 lg:grid-cols-[.7fr_1fr_.45fr]">
                <div class="relative h-32 overflow-hidden rounded-2xl bg-[#6a7154] p-5 text-white shadow-lg shadow-[#555a42]/20">
                    <p class="text-xs font-black uppercase tracking-[0.16em] opacity-80">Member card</p>
                    <p class="mt-5 font-display text-2xl font-black uppercase">Store club</p>
                </div>
                <div>
                    <h2 class="font-display text-3xl font-black uppercase text-[#20221b]">Gabung ke store club</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-[#65685c]">Dapatkan akses promo, info produk baru, dan benefit belanja yang dibuat untuk pelanggan rutin.</p>
                    <div class="mt-5 grid gap-3 text-xs font-bold text-[#555a42] sm:grid-cols-3">
                        <span>Bonus poin</span>
                        <span>Promo eksklusif</span>
                        <span>Notifikasi produk baru</span>
                    </div>
                </div>
                <a href="{{ route('product-catalog') }}" class="inline-flex justify-center rounded-full bg-[#555a42] px-6 py-3 text-sm font-black text-white transition hover:bg-[#3f4331]">
                    Mulai belanja
                </a>
            </div>
        </div>
    </section>
</div>
