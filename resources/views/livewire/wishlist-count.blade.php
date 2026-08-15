<div>
    @auth
        <a class="relative inline-flex h-11 items-center justify-center rounded-full bg-[#f2f3ed] px-3 text-[#555a42] transition hover:bg-[#e6e8de]"
            href="{{ route('account.wishlist') }}" aria-label="Wishlist" title="Wishlist">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
            </svg>
            @if ($count > 0)
                <span class="absolute -top-1 -right-1 flex size-4 items-center justify-center rounded-full bg-red-500 text-[9px] font-black text-white">
                    {{ $count > 99 ? '99+' : $count }}
                </span>
            @endif
        </a>
    @endauth
</div>
