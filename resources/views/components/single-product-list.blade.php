@props(['cart_item'])
<div class="flex items-center gap-3 py-1">
    <div class="relative h-16 w-16 flex-shrink-0 overflow-hidden rounded-2xl border border-[#d7c7ad] bg-[#f4ead9]">
        <img class="size-full object-cover" src="{{ $cart_item->product()->cover_url }}" alt="{{ $cart_item->product()->name }}">
    </div>
    <div class="min-w-0 flex-grow">
        <h3 class="truncate text-sm font-black text-[#211b14]">{{ $cart_item->product()->name }}</h3>
        <p class="mt-0.5 truncate text-xs text-[#77664c]">{{ $cart_item->product()->short_desc }}</p>
        <p class="mt-1 text-xs font-black text-[#4d4634]">{{ $cart_item->product()->price_formatted }} <span class="font-medium text-[#8a7a61]">x {{ $cart_item->quantity }}</span></p>
    </div>
</div>
