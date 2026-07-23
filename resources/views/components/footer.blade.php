<footer class="w-full mt-auto border-t border-[#e2e8f0] bg-[#f8fafc]">
    <div class="max-w-[90rem] py-14 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-4">

            {{-- Brand column --}}
            <div class="col-span-full lg:col-span-1">
                <a class="text-xl font-extrabold text-[#0f2d5a] tracking-tight focus:outline-hidden focus:opacity-80" href="{{ url('/') }}" aria-label="Brand">
                    {{ config('app.name') }}
                </a>
                <p class="mt-3 text-sm text-[#4b6489] leading-relaxed max-w-xs">
                    Curating premium fashion for the modern individual. Quality craftsmanship meets contemporary design.
                </p>
                <div class="flex gap-2 mt-5">
                    <a href="#" class="size-8 flex items-center justify-center rounded-full bg-[#e8eef6] text-[#4b6489] hover:bg-[#1e40af] hover:text-white transition-all duration-200">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="size-8 flex items-center justify-center rounded-full bg-[#e8eef6] text-[#4b6489] hover:bg-[#1e40af] hover:text-white transition-all duration-200">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                    <a href="#" class="size-8 flex items-center justify-center rounded-full bg-[#e8eef6] text-[#4b6489] hover:bg-[#1e40af] hover:text-white transition-all duration-200">
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                </div>
            </div>

            {{-- Shop links --}}
            <div>
                <h4 class="text-[10px] font-bold text-[#0f2d5a] uppercase tracking-widest">Shop</h4>
                <div class="mt-4 space-y-2.5">
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('product-catalog') }}">All Products</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('product-catalog') }}">New Arrivals</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('product-catalog') }}">Best Sellers</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('product-catalog') }}">Sale</a></p>
                </div>
            </div>

            {{-- Support links --}}
            <div>
                <h4 class="text-[10px] font-bold text-[#0f2d5a] uppercase tracking-widest">Support</h4>
                <div class="mt-4 space-y-2.5">
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('page') }}">Terms &amp; Conditions</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('page') }}">Privacy Policy</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('page') }}">Shipping Info</a></p>
                    <p><a class="text-sm text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200" href="{{ route('page') }}">Returns</a></p>
                </div>
            </div>

            {{-- Partners & Payments --}}
            <div>
                <h4 class="text-[10px] font-bold text-[#0f2d5a] uppercase tracking-widest">Partners</h4>
                <div class="mt-4 flex flex-wrap gap-2">
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/shipping/idexpress.webp') }}" alt="idexpress" class="h-4" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/shipping/jne.svg') }}" alt="jne" class="h-4" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/shipping/jntexpress.svg') }}" alt="jnt" class="h-4" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/shipping/ninjaexpress.webp') }}" alt="ninja" class="h-4" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/shipping/sicepat.webp') }}" alt="sicepat" class="h-4" />
                    </div>
                </div>

                <h4 class="mt-6 text-[10px] font-bold text-[#0f2d5a] uppercase tracking-widest">Payments</h4>
                <div class="mt-4 flex flex-wrap gap-2">
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/bank/bca-bank-central-asia.svg') }}" class="h-4" alt="bca" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/bank/bank-mandiri.svg') }}" class="h-4" alt="mandiri" />
                    </div>
                    <div class="h-7 px-2 bg-white border border-[#e2e8f0] rounded flex items-center shadow-sm">
                        <img src="{{ asset('images/bank/bank-negara-indonesia.svg') }}" class="h-4" alt="BNI" />
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom bar --}}
        <div class="mt-10 pt-6 border-t border-[#e2e8f0] flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-[#4b6489]">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p class="text-xs text-[#4b6489]">Designed with ❤️ for premium shopping</p>
        </div>
    </div>
</footer>
