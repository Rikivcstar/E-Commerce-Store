<x-layouts.app>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 my-5 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-2 md:col-span-7" data-aos="fade-right">
                <div class="w-full">
                    <img src="{{ $product->cover_url }}"
                        alt="{{ $product->name }}" class="object-cover w-full rounded-md aspect-3/2 md:col-span-3 shadow-xs">

                    <div class="grid grid-cols-1 gap-3 my-4 md:grid-cols-3 md:col-span-7">
                     @foreach ($product->gallery as $key =>$image )
                        <img src="{{$image}}"
                            alt="image-{{ $key }}" class="object-cover rounded-md aspect-square shadow-xs hover:scale-102 transition-transform duration-200" />
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 flex flex-col gap-6" data-aos="fade-left">
                <div class="flex flex-col gap-2">
                    <div>
                        <span class="inline-block text-xs font-semibold text-[#1e40af] tracking-[0.1em] uppercase mb-1">
                            {{ $product->sku }}
                        </span>
                        <h1 class="text-3xl text-[#0f2d5a] font-extrabold tracking-tight leading-tight">{{ $product->name }}</h1>
                        <p class="text-sm text-[#4b6489] mt-2 font-medium">{{ $product->short_desc }}</p>
                    </div>
                    <span class="mt-4 text-2xl text-[#1e40af] font-black">{{ $product->price_formatted }}</span>
                </div>
                
                <div class="border-t border-[#e2e8f0] pt-4">
                    <livewire:add-to-card :product="$product" />
                </div>

                <div class="border-t border-[#e2e8f0] pt-6">
                    <h3 class="font-bold text-[#0f2d5a] text-lg mb-2">Description</h3>
                    <div class="my-2 prose text-[#4b6489] leading-relaxed">
                        {!! Str::markDown($product->description)!!}
                    </div>
                </div>
            </div>
            <div class="md:col-span-10">
                {{-- <x-product-sections title="You may also like" :url="route('product-catalog')" /> --}}
            </div>
        </div>
    </div>
</x-layouts.app>
