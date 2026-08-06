@props(['cart_item'])
<div class="flex items-start gap-4 py-3 border-b border-neutral-200/80 last:border-b-0">
    <div class="relative h-20 w-16 flex-shrink-0 overflow-hidden bg-neutral-100 border border-neutral-200">
        <img class="size-full object-cover" src="{{ $cart_item->product()->cover_url }}" alt="{{ $cart_item->product()->name }}">
    </div>
    <div class="min-w-0 flex-grow pt-0.5">
        <h3 class="font-display text-xs font-bold uppercase tracking-tight text-neutral-900 leading-tight">{{ $cart_item->product()->name }}</h3>
        @if($cart_item->product()->short_desc)
            <p class="mt-1 text-[11px] text-neutral-500 line-clamp-1 leading-snug">{{ $cart_item->product()->short_desc }}</p>
        @endif
        <div class="mt-2 text-[11px] text-neutral-500 font-medium space-y-0.5">
            <p>Quantity: <span class="text-neutral-900 font-bold">{{ $cart_item->quantity }}</span></p>
        </div>
    </div>
    <div class="text-right flex-shrink-0 pt-0.5">
        <p class="text-xs font-bold text-neutral-900 tracking-tight">{{ $cart_item->product()->price_formatted }}</p>
    </div>
</div>
