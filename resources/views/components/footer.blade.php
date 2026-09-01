<footer class="w-full bg-[#0d0d0d] text-white">
    <div class="mx-auto max-w-[92rem] px-4 py-12 sm:px-6 lg:px-8">
        <!-- TOP CTA SECTION -->
        <div class="grid grid-cols-1 gap-8 border-b border-neutral-800 pb-16 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-4">
                <h3 class="font-display text-xl font-bold uppercase tracking-wider text-white sm:text-2xl">
                    {{ __('GET IN TOUCH') }}<br>{{ __('WITH') }} {{ strtoupper(config('app.name')) }}
                </h3>
                <p class="mt-3 text-xs leading-relaxed text-neutral-400 max-w-sm">
                    {{ __('Contact us and our managers will be happy to answer all your questions.') }}
                </p>
            </div>
            <div class="lg:col-span-8 lg:text-right">
                <h2
                    class="font-display text-4xl font-black uppercase leading-[0.9] tracking-tighter text-white sm:text-6xl lg:text-7xl">
                    {{ __('CREATE YOUR') }}<br>{{ __('OWN UNIQUE') }}<br>{{ __('LOOK') }}
                </h2>
            </div>
        </div>

        <!-- LOWER NAVIGATION & INFO SECTION -->
        <div class="grid grid-cols-1 gap-10 pt-12 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-12">
            <!-- BRAND & LEGAL COLUMN -->
            <div class="flex flex-col justify-between lg:col-span-3">
                <div>
                    <a href="{{ url('/') }}"
                        class="flex items-center gap-3 font-display text-2xl font-black uppercase tracking-tight text-white hover:opacity-90 transition">
                        <img src="{{ asset('images/logo.png') }}" class="size-10 object-contain rounded-full bg-white p-0.5 border border-amber-400/30" alt="{{ config('app.name') }}">
                        <div>
                            <span class="block leading-none">{{ config('app.name') }}</span>
                            <span class="block text-[10px] font-bold uppercase tracking-[0.2em] text-amber-300/80 mt-1">Curated Goods</span>
                        </div>
                    </a>
                    <div class="mt-4 space-y-1.5 text-xs text-neutral-400">
                        <p><a href="{{ route('page') }}" class="hover:text-white transition">{{ __('Terms & Conditions') }}</a></p>
                        <p><a href="{{ route('page') }}" class="hover:text-white transition">{{ __('Privacy Policy') }}</a></p>
                    </div>
                </div>
                <div class="mt-8 text-[11px] text-neutral-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved') }}.
                </div>
            </div>

            <!-- NAVIGATION COLUMN -->
            <div class="lg:col-span-3">
                <h4 class="text-[11px] font-black uppercase tracking-[0.2em] text-neutral-400">{{ __('Navigation') }}</h4>
                <ul class="mt-5 space-y-2.5 text-xs uppercase tracking-wider text-neutral-300">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition font-medium">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('product-catalog') }}"
                            class="hover:text-white transition font-medium">{{ __('Catalog') }}</a></li>
                    <li><a href="{{ route('product-catalog') }}" class="hover:text-white transition font-medium">{{ __('New In') }}</a></li>
                    <li><a href="{{ route('cart') }}" class="hover:text-white transition font-medium">{{ __('Shopping Bag') }}</a>
                    </li>
                </ul>
            </div>

            <!-- INFO COLUMN -->
            <div class="lg:col-span-3">
                <h4 class="text-[11px] font-black uppercase tracking-[0.2em] text-neutral-400">{{ __('Info & Help') }}</h4>
                <ul class="mt-5 space-y-2.5 text-xs uppercase tracking-wider text-neutral-300">
                    @php
                        $footerPages = \App\Models\Page::query()->active()->get();
                    @endphp
                    @forelse($footerPages as $fPage)
                        <li><a href="{{ route('page', $fPage->slug) }}"
                                class="hover:text-white transition font-medium">{{ $fPage->name }}</a></li>
                    @empty
                        <li><a href="{{ route('page') }}" class="hover:text-white transition font-medium">{{ __('Pusat Informasi') }}</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- NEWSLETTER & PAYMENTS COLUMN -->
            <div class="lg:col-span-3">

                <!-- Payment Methods Badges -->
                <div class="mt-8 flex flex-wrap items-center gap-2.5 text-neutral-400">
                    <!-- Apple Pay Badge -->
                    <span
                        class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        Qris
                    </span>
                    <!-- G Pay Badge -->
                    <span
                        class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        BCA
                    </span>
                    <!-- Visa Badge -->
                    <span
                        class="inline-flex items-center text-[11px] font-black italic tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        VISA
                    </span>
                    <!-- Mastercard Badge -->
                    <span
                        class="inline-flex items-center gap-1 text-[11px] font-black uppercase tracking-tighter bg-neutral-900 border border-neutral-800 px-2.5 py-1 rounded-sm text-white">
                        <span class="size-2.5 rounded-full bg-red-500 inline-block"></span>
                        <span class="size-2.5 rounded-full bg-yellow-500 inline-block -ml-2 opacity-80"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
