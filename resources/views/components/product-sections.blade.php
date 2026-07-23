@props(['title' => 'Title Section', 'url' => '#', 'products' => []])

<div class="py-14">
    <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex items-end justify-between mb-10" data-aos="fade-up" data-aos-duration="500">
            <div>
                <span class="inline-block text-xs font-semibold text-[#1e40af] tracking-[0.15em] uppercase mb-2">Collection</span>
                <h2 class="text-2xl md:text-3xl font-bold text-[#0f2d5a] tracking-tight">{{ $title }}</h2>
            </div>
            @if($url !== '#')
            <a href="{{ $url }}" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200 group">
                View All
                <svg class="size-4 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                </svg>
            </a>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-5">
            @foreach ($products as $product)
                <x-single-product-card :product="$product" />
            @endforeach
        </div>
        @if($url !== '#')
        <div class="mt-8 text-center sm:hidden">
            <a href="{{ $url }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-[#1e40af] transition-colors duration-200">
                View All Products
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>
        @endif
    </div>
</div>
