@props(['cart_item'])
<div class="flex items-center gap-3 py-1">
    <div class="relative overflow-hidden rounded-lg h-14 w-14 border border-[#e2e8f0] flex-shrink-0">
        <img class="object-cover size-full"
            src="{{ $cart_item->product()->cover_url }}"
            alt="{{ $cart_item->product()->name }}">
    </div>
    <div class="flex-grow">
        <h3 class="text-[#0f2d5a] text-sm font-semibold leading-tight">
            {{ $cart_item->product()->name }}
        </h3>
        <p class="text-xs text-[#4b6489] mt-0.5">{{ $cart_item->product()->short_desc }}</p>
        <p class="mt-1 text-xs font-bold text-[#1e40af]">
            {{ $cart_item->product()->price_formatted }} <span class="text-[#4b6489] font-normal">x {{ $cart_item->quantity }}</span>
        </p>
    </div>
</div>
