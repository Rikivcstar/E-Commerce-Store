<a  data-aos ="zoom-in"
    data-aos-delay="100"
    data-aos-duration="1500"
    wire: class="flex flex-col bg-[#101820] group rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70"
    href="{{ route('product', $product->slug) }}">
    <img class="object-cover rounded-md aspect-square"
        src="{{ $product->cover_url }}"
        alt="{{ $product->name }}">
    <div class="py-5 bg-[#101820]">
        <h3 class="text-lg font-bold text-white">
            {{ $product->name }}
        </h3>
        <span class="text-sm text-[#FEE715]">
            {{ $product->short_desc }}
        </span>
        <p class="mt-1 font-semibold text-white">
            {{ $product->price_formatted }}
        </p>
    </div>
</a>
