<footer class="w-full bg-[#0d0d0d] text-white">
    <div class="mx-auto max-w-[92rem] px-4 py-12 sm:px-6 lg:px-8">
        <!-- TOP CTA SECTION -->
        <div class="grid grid-cols-1 gap-8 border-b border-neutral-800 pb-16 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-4">
                <h3 class="font-display text-xl font-bold uppercase tracking-wider text-white sm:text-2xl">
                    GET IN TOUCH<br>WITH {{ strtoupper(config('app.name')) }}
                </h3>
                <p class="mt-3 text-xs leading-relaxed text-neutral-400 max-w-sm">
                    Contact us and our managers will be happy to answer all your questions.
                </p>
            </div>
            <div class="lg:col-span-8 lg:text-right">
                <h2 class="font-display text-4xl font-black uppercase leading-[0.9] tracking-tighter text-white sm:text-6xl lg:text-7xl">
                    CREATE YOUR<br>OWN UNIQUE<br>LOOK
                </h2>
            </div>
        </div>

        <!-- LOWER NAVIGATION & INFO SECTION -->
        <div class="grid grid-cols-1 gap-10 pt-12 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-12">
            <!-- BRAND & LEGAL COLUMN -->
            <div class="flex flex-col justify-between lg:col-span-3">
                <div>
                    <a href="{{ url('/') }}" class="font-display text-2xl font-black uppercase tracking-tight text-white hover:opacity-90 transition">
                        {{ config('app.name') }}
                    </a>
                    <div class="mt-4 space-y-1.5 text-xs text-neutral-400">
                        <p><a href="{{ route('page') }}" class="hover:text-white transition">Terms & Conditions</a></p>
                        <p><a href="{{ route('page') }}" class="hover:text-white transition">Privacy Policy</a></p>
                    </div>
                </div>
                <div class="mt-8 text-[11px] text-neutral-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>

            <!-- NAVIGATION COLUMN -->
            <div class="lg:col-span-3">
                <h4 class="text-[11px] font-black uppercase tracking-[0.2em] text-neutral-400">Navigation</h4>
                <ul class="mt-5 space-y-2.5 text-xs uppercase tracking-wider text-neutral-300">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition font-medium">Home</a></li>
                    <li><a href="{{ route('product-catalog') }}" class="hover:text-white transition font-medium">Catalog</a></li>
                    <li><a href="{{ route('product-catalog') }}" class="hover:text-white transition font-medium">New In</a></li>
                    <li><a href="{{ route('cart') }}" class="hover:text-white transition font-medium">Shopping Bag</a></li>
                </ul>
            </div>

            <!-- INFO COLUMN -->
            <div class="lg:col-span-3">
                <h4 class="text-[11px] font-black uppercase tracking-[0.2em] text-neutral-400">Info & Help</h4>
                <ul class="mt-5 space-y-2.5 text-xs uppercase tracking-wider text-neutral-300">
                    @php
                        $footerPages = \App\Models\Page::query()->active()->get();
                    @endphp
                    @forelse($footerPages as $fPage)
                        <li><a href="{{ route('page', $fPage->slug) }}" class="hover:text-white transition font-medium">{{ $fPage->name }}</a></li>
                    @empty
                        <li><a href="{{ route('page') }}" class="hover:text-white transition font-medium">Pusat Informasi</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- NEWSLETTER & PAYMENTS COLUMN -->
            <div class="lg:col-span-3">
                <h4 class="text-[11px] font-black uppercase tracking-[0.2em] text-neutral-400">Newsletter</h4>
                <form onsubmit="event.preventDefault();" class="mt-5 relative">
                    <input type="email" placeholder="EMAIL" class="w-full border-b border-neutral-700 bg-transparent pb-2 pr-8 text-xs font-semibold text-white placeholder-neutral-500 uppercase tracking-widest focus:border-white focus:outline-none transition">
                    <button type="submit" class="absolute right-0 top-0 text-neutral-400 hover:text-white transition" aria-label="Subscribe">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </button>
                </form>

                <!-- Payment Methods Badges -->
                <div class="mt-8 flex flex-wrap items-center gap-2.5 text-neutral-400">
                    <!-- Apple Pay Badge -->
                    <span class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        <svg class="size-3.5 fill-current" viewBox="0 0 170 170"><path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.34.13-9.16-1.9-14.49-6.1-3.32-2.79-7.29-7.56-11.91-14.31-6.72-9.78-11.91-20.65-15.58-32.61-3.67-11.96-5.5-23.49-5.5-34.59 0-14.35 3.67-26.17 11.01-35.46 7.34-9.29 16.47-14.07 27.39-14.34 4.58 0 9.77 1.17 15.58 3.52 5.81 2.35 9.87 3.52 12.18 3.52 2.01 0 6.13-1.23 12.35-3.69 6.22-2.46 11.28-3.58 15.18-3.35 11.96.67 21.46 4.96 28.5 12.87-10.45 6.32-15.53 15.35-15.24 27.09.28 9.3 3.96 17.06 11.04 23.27 7.08 6.2 15.42 9.69 25.02 10.46-2.57 7.7-6.03 15.42-10.38 23.16zM119.22 31.63c0-6.7 2.45-13.31 7.35-19.82 4.9-6.52 11.17-10.74 18.82-12.67.28 1.12.42 2.12.42 3.01 0 6.7-2.43 13.28-7.29 19.74-4.86 6.46-11.11 10.66-18.75 12.6-0.19-.85-0.55-1.81-0.55-2.86z"/></svg>
                        Pay
                    </span>
                    <!-- G Pay Badge -->
                    <span class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        <span class="text-blue-400 font-black">G</span> Pay
                    </span>
                    <!-- Visa Badge -->
                    <span class="inline-flex items-center text-[11px] font-black italic tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        VISA
                    </span>
                    <!-- Mastercard Badge -->
                    <span class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        <span class="size-2.5 rounded-full bg-red-500 inline-block"></span>
                        <span class="size-2.5 rounded-full bg-yellow-500 inline-block -ml-2 opacity-80"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
