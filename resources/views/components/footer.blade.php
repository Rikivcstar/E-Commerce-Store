<footer class="w-full bg-[#f7f7f2] px-3 pb-6 sm:px-5 lg:px-8">
    <div class="mx-auto max-w-[92rem] overflow-hidden rounded-[1.5rem] bg-white shadow-sm ring-1 ring-black/5">
        <div class="grid border-b border-[#eceee6] sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Pengiriman cepat', 'Partner kurir tepercaya'],
                ['Retur mudah', 'Proses bantuan jelas'],
                ['Produk original', 'Kualitas toko terjaga'],
                ['Support responsif', 'Bantuan saat dibutuhkan'],
            ] as [$title, $desc])
                <div class="flex items-center gap-4 border-b border-[#eceee6] p-5 last:border-b-0 sm:[&:nth-child(3)]:border-b-0 lg:border-b-0 lg:border-r lg:last:border-r-0">
                    <span class="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-[#eef0e7] text-[#555a42]">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.68 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-sm font-black text-[#20221b]">{{ $title }}</h3>
                        <p class="mt-1 text-xs text-[#777b6d]">{{ $desc }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid gap-8 p-6 sm:p-8 md:grid-cols-2 lg:grid-cols-[1.35fr_.75fr_.75fr_1fr]">
            <div>
                <a class="inline-flex items-center gap-3 focus:outline-hidden focus:opacity-80" href="{{ url('/') }}" aria-label="Brand">
                    <span class="flex size-10 items-center justify-center rounded-2xl bg-[#eef0e7] text-[#555a42]">
                        <span class="h-0.5 w-6 -rotate-[18deg] rounded-full bg-[#555a42]"></span>
                    </span>
                    <span class="font-display text-xl font-black uppercase text-[#20221b]">{{ config('app.name') }}</span>
                </a>
                <p class="mt-4 max-w-sm text-sm leading-6 text-[#686c60]">
                    Store modern untuk produk pilihan harian, dibuat agar pengalaman belanja terasa cepat, jelas, dan nyaman.
                </p>
                <div class="mt-5 flex gap-2">
                    @foreach (['IG', 'TT', 'YT'] as $social)
                        <a href="#" class="flex size-9 items-center justify-center rounded-full bg-[#f2f3ed] text-[11px] font-black text-[#555a42] transition hover:bg-[#555a42] hover:text-white">{{ $social }}</a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#20221b]">Catalog</h4>
                <div class="mt-4 space-y-3">
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('product-catalog') }}">Semua produk</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('product-catalog') }}">Produk baru</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('product-catalog') }}">Promo</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('product-catalog') }}">Terlaris</a></p>
                </div>
            </div>

            <div>
                <h4 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#20221b]">Bantuan</h4>
                <div class="mt-4 space-y-3">
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('page') }}">Syarat layanan</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('page') }}">Privasi</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('page') }}">Pengiriman</a></p>
                    <p><a class="text-sm font-medium text-[#686c60] transition hover:text-[#20221b]" href="{{ route('page') }}">Kontak</a></p>
                </div>
            </div>

            <div>
                <h4 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#20221b]">Partner</h4>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ([
                        ['images/shipping/idexpress.webp', 'idexpress'],
                        ['images/shipping/jne.svg', 'jne'],
                        ['images/shipping/jntexpress.svg', 'jnt'],
                        ['images/shipping/ninjaexpress.webp', 'ninja'],
                        ['images/shipping/sicepat.webp', 'sicepat'],
                    ] as [$src, $alt])
                        <div class="flex h-8 items-center rounded-full bg-[#f7f7f2] px-3 ring-1 ring-black/5">
                            <img src="{{ asset($src) }}" alt="{{ $alt }}" class="h-4" />
                        </div>
                    @endforeach
                </div>

                <h4 class="mt-6 text-[11px] font-black uppercase tracking-[0.14em] text-[#20221b]">Pembayaran</h4>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ([
                        ['images/bank/bca-bank-central-asia.svg', 'bca'],
                        ['images/bank/bank-mandiri.svg', 'mandiri'],
                        ['images/bank/bank-negara-indonesia.svg', 'bni'],
                    ] as [$src, $alt])
                        <div class="flex h-8 items-center rounded-full bg-[#f7f7f2] px-3 ring-1 ring-black/5">
                            <img src="{{ asset($src) }}" alt="{{ $alt }}" class="h-4" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 border-t border-[#eceee6] px-6 py-5 text-xs text-[#777b6d] sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Privacy policy · Terms of service</p>
        </div>
    </div>
</footer>
