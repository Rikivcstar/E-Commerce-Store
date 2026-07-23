<div>
    <button wire:click='remove()' type="button" class="py-2 px-2.5 inline-flex items-center justify-center text-sm font-medium rounded-lg border border-red-100 text-red-600 bg-red-50/50 hover:bg-red-50 hover:text-red-800 transition-colors duration-150 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
        <svg class="size-4 shrink-0 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
        </svg>

        <div wire:loading class="animate-spin inline-block size-3.5 border-2 border-current border-t-transparent text-red-600 rounded-full ml-1" role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </button>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/cart-remove.blade.php ENDPATH**/ ?>