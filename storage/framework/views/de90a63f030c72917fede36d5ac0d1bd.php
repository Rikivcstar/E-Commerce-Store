<div>
    <button wire:click="toggle" type="button"
        class="nexora-wish <?php echo e($isInWishlist ? 'nexora-wish-active' : 'nexora-wish-inactive'); ?>"
        aria-label="Wishlist">
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="<?php echo e($isInWishlist ? 'currentColor' : 'none'); ?>" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
        </svg>
        <span>
            <?php echo e($isInWishlist ? 'Disimpan' : 'Simpan'); ?>

        </span>
        <div wire:loading wire:target="toggle" class="inline-block size-3.5 animate-spin rounded-full border-2 border-current border-t-transparent" role="status"><span class="sr-only">Loading...</span></div>
    </button>

    <style>
        .nexora-wish {
            min-height: 3rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: 0 1.1rem;
            border-radius: 999px;
            border: 1px solid #dfd8c9;
            background: #fff;
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .06em;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease, color .2s ease;
        }
        .nexora-wish:hover {
            transform: translateY(-2px);
        }
        .nexora-wish-inactive {
            color: #4d4634;
            background: #fff;
        }
        .nexora-wish-inactive:hover {
            background: #fdf1e3;
            border-color: #c9b48d;
        }
        .nexora-wish-active {
            color: #fff;
            background: #a13a3a;
            border-color: #a13a3a;
        }
    </style>
</div><?php /**PATH C:\laraherd\webstore\resources\views/livewire/wishlist-toggle.blade.php ENDPATH**/ ?>