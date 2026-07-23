<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
    :class="scrolled ? 'bg-white shadow-md shadow-[#0f2d5a]/10' : 'bg-white/98 backdrop-blur-sm'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 h-17 flex flex-wrap w-full md:justify-start md:flex-nowrap border-b border-[#e2e8f0]">
    <nav class="relative max-w-[90rem] w-full md:flex md:items-center md:justify-between md:gap-3 mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex items-center justify-between">
            <a class="flex-none text-xl font-extrabold focus:outline-hidden focus:opacity-80 text-[#0f2d5a] tracking-tight"
                href="{{ url('/') }}" aria-label="Brand">{{ config('app.name') }}
            </a>

            <div class="md:hidden">
                <button @click="mobileOpen = !mobileOpen" type="button"
                    class="relative flex items-center justify-center text-sm font-semibold text-[#0f2d5a] border border-[#e2e8f0] rounded-lg size-9 hover:bg-[#f0f4f9] focus:outline-hidden focus:bg-[#f0f4f9]"
                    aria-label="Toggle navigation">
                    <svg x-show="!mobileOpen" class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg x-show="mobileOpen" class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
        </div>

        <div
            x-show="mobileOpen"
            x-transition:enter="transition-all duration-300 ease-out"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition-all duration-200 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:!block basis-full grow md:!opacity-100 md:!translate-y-0"
        >
            <div class="overflow-hidden overflow-y-auto max-h-[75vh] py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-0.5 md:gap-1">
                <a class="flex items-center p-2 px-4 text-sm font-medium text-[#0f2d5a] hover:text-[#1e40af] transition-colors duration-200 rounded-lg hover:bg-[#f0f4f9]"
                    href="{{ url('/') }}" aria-current="page">
                    <svg class="block shrink-0 size-4 me-3 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                    Home
                </a>

                <a class="flex items-center p-2 px-4 text-sm font-medium text-[#0f2d5a] hover:text-[#1e40af] transition-colors duration-200 rounded-lg hover:bg-[#f0f4f9]"
                    href="{{ route('product-catalog') }}">
                    <svg class="block shrink-0 size-4 me-3 md:me-2 md:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" />
                    </svg>
                    Collection
                </a>

                <livewire:cart-count/>
            </div>
        </div>
    </nav>
</header>
