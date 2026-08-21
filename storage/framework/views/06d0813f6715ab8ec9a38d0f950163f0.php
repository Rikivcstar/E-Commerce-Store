<div>
    <button wire:click="remove()" type="button"
        class="inline-flex size-10 items-center justify-center rounded-full border border-rose-200 bg-rose-50 text-rose-600 transition hover:bg-rose-100 hover:text-rose-800 cursor-pointer"
        aria-label="Hapus dari wishlist">
        <svg class="size-4 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
        </svg>
        <div wire:loading wire:target="remove" class="inline-block size-3.5 animate-spin rounded-full border-2 border-current border-t-transparent" role="status"><span class="sr-only">Loading...</span></div>
    </button>
</div><?php /**PATH C:\laraherd\webstore\resources\views\livewire\wishlist-remove.blade.php ENDPATH**/ ?>