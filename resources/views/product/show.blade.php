<x-layouts.app>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
      <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 my-5 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-2 md:col-span-7">
                <div class="w-full">
                    <img src="{{ $product->cover_url }}"
                        alt="{{ $product->name }}" class="object-cover w-full rounded-md aspect-3/2 md:col-span-3">

                    <div class="grid grid-cols-1 gap-2 my-2 md:grid-cols-3 md:col-span-7">
                     @foreach ($product->gallery as $key =>$image )
                        <img src="{{$image}}"
                            alt="image-1" class="object-cover rounded-md aspect-square" />
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="md:col-span-3">
                <div class="flex flex-col gap-2">
                    <div>
                        <h1 class="text-3xl text-white font-semibold">{{ $product->name }}</h1>
                        <h2 class="text-sm text-[#FEE715]">{{ $product->short_desc }}</h2>
                        <h3 class="text-xs text-[#FEE715]">{{ $product->sku }}</h2>
                    </div>
                    <span class="mt-2 text-2xl text-white font-bold">{{ $product->price_formatted }}</span>
                </div>
                <div>
                    <livewire:add-to-card :product="$product" />
                </div>
                <div>
                    <h3 class="font-bold text-[#FEE715]">Description</h3>
                    <div class="my-2 prose text-slate-100 dark:text-neutral-200">
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
