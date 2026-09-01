<div>
    <a class="relative inline-flex h-11 items-center gap-2 rounded-full bg-[#555a42] px-4 text-xs font-black text-white shadow-sm shadow-[#555a42]/20 transition hover:-translate-y-0.5 hover:bg-[#3f4331]"
        href="{{ route('cart') }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="8" cy="21" r="1" />
            <circle cx="19" cy="21" r="1" />
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
        </svg>
        <span>{{ $count }}</span>
        <span class="hidden sm:inline">{{ __('Cart') }}</span>
    </a>
</div>
