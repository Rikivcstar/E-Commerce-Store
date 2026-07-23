<x-store-layout title="Homepage">

    {{-- Hero Banner --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0f2d5a] via-[#1a3a7a] to-[#1e40af]">
        {{-- Decorative circles --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-16 -left-16 w-72 h-72 bg-white/5 rounded-full"></div>
            <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-blue-400/10 rounded-full blur-2xl"></div>
        </div>

        <div class="relative max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 flex flex-col md:flex-row items-center gap-12">
            {{-- Left: Text content --}}
            <div class="flex-1 text-center md:text-left" data-aos="fade-right" data-aos-duration="700">
                <span class="inline-block bg-white/10 border border-white/20 text-blue-200 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 tracking-widest uppercase backdrop-blur-sm">
                    ✦ New Collection 2026
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight">
                    Discover Premium<br>
                    <span class="text-blue-200">Fashion &amp; Style</span>
                </h1>
                <p class="mt-6 text-base md:text-lg text-white/65 max-w-xl leading-relaxed">
                    Curating the finest selection of contemporary fashion. Quality craftsmanship meets modern design — shop the latest arrivals and bestsellers.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('product-catalog') }}"
                        class="inline-flex items-center justify-center gap-2 bg-white text-[#0f2d5a] font-bold px-8 py-3.5 rounded-xl hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-sm">
                        Shop Now
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#featured"
                        class="inline-flex items-center justify-center gap-2 bg-white/10 text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-white/20 border border-white/25 transition-all duration-200 backdrop-blur-sm text-sm">
                        Explore Collection
                    </a>
                </div>
            </div>

            {{-- Right: Stats cards --}}
            <div class="flex-1 hidden md:flex justify-end items-center gap-5" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                <div class="flex flex-col gap-5">
                    <div class="w-44 h-52 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 flex flex-col items-center justify-center gap-2 hover:bg-white/15 transition-colors duration-300">
                        <svg class="size-8 text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                        </svg>
                        <p class="text-white font-bold text-2xl">2K+</p>
                        <p class="text-white/50 text-xs font-medium text-center px-4">Premium Products</p>
                    </div>
                    <div class="w-44 h-36 bg-white/[0.07] rounded-2xl backdrop-blur-sm border border-white/15 flex flex-col items-center justify-center gap-1 hover:bg-white/12 transition-colors duration-300">
                        <p class="text-white font-bold text-xl">5★</p>
                        <p class="text-white/50 text-xs font-medium">Top Rated</p>
                    </div>
                </div>
                <div class="flex flex-col gap-5 mt-10">
                    <div class="w-44 h-36 bg-white/[0.07] rounded-2xl backdrop-blur-sm border border-white/15 flex flex-col items-center justify-center gap-1 hover:bg-white/12 transition-colors duration-300">
                        <p class="text-white font-bold text-xl">50K+</p>
                        <p class="text-white/50 text-xs font-medium">Happy Customers</p>
                    </div>
                    <div class="w-44 h-52 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 flex flex-col items-center justify-center gap-2 hover:bg-white/15 transition-colors duration-300">
                        <svg class="size-8 text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <p class="text-white font-bold text-xl">Free</p>
                        <p class="text-white/50 text-xs font-medium text-center px-4">Shipping Nationwide</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-8 md:h-10">
                <path d="M0 40L60 34.7C120 29.3 240 18.7 360 16C480 13.3 600 18.7 720 21.3C840 24 960 24 1080 21.3C1200 18.7 1320 13.3 1380 10.7L1440 8V40H1380C1320 40 1200 40 1080 40C960 40 840 40 720 40C600 40 480 40 360 40C240 40 120 40 60 40H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    {{-- Category quick-links bar --}}
    <section class="border-b border-[#e2e8f0] bg-[#f8fafc]">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto py-3.5">
            <div class="flex items-center gap-8 overflow-x-auto scrollbar-hide">
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-semibold text-[#1e40af] pb-1 border-b-2 border-[#1e40af] whitespace-nowrap transition-all duration-200">All Products</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">New Arrivals</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Best Sellers</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Sale</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Accessories</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Men</a>
                <a href="{{ route('product-catalog') }}" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Women</a>
            </div>
        </div>
    </section>

    {{-- Main content sections --}}
    <div id="featured" class="container mx-auto max-w-[85rem] w-full">
        <div class="mt-4">
            <x-product-sections title="Featured Products" :url="route('product-catalog')" />
            <x-featured-icon />
            <x-product-sections title="Latest Products" :url="route('product-catalog')" />
        </div>
    </div>

    {{-- Newsletter / CTA Banner --}}
    <section class="bg-[#f0f4f9] py-16">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="bg-gradient-to-r from-[#0f2d5a] to-[#1e40af] rounded-2xl px-8 md:px-16 py-12 text-center relative overflow-hidden" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
                <div class="relative">
                    <span class="inline-block text-blue-200 text-xs font-semibold tracking-widest uppercase mb-3">Exclusive Deals</span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">Don't Miss Out on New Arrivals</h2>
                    <p class="text-white/60 text-sm mb-8 max-w-md mx-auto">Get the latest products delivered straight to you. Shop our full collection and enjoy premium quality.</p>
                    <a href="{{ route('product-catalog') }}"
                        class="inline-flex items-center gap-2 bg-white text-[#0f2d5a] font-bold px-8 py-3 rounded-xl hover:bg-blue-50 transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5 text-sm">
                        Browse All Products
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-store-layout>
