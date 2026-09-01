<div class="riva-buybox">
    <style>
        .riva-buybox { margin-top: 1.25rem; }
        .riva-buybox-row { display: flex; align-items: center; gap: .75rem; width: 100%; flex-wrap: wrap; }
        .riva-qty { display: inline-flex; align-items: center; gap: .55rem; height: 3rem; padding: 0 .75rem; border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 999px; }
        .riva-qty button { width: 1.8rem; height: 1.8rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 999px; border: 1px solid #dfd0b7; background: #f4ead9; color: #4d4634; cursor: pointer; transition: .2s ease; }
        .riva-qty button:hover { background: #e7d7bd; }
        .riva-qty input { width: 2rem; padding: 0; border: 0; background: transparent; color: #211b14; font-weight: 900; text-align: center; outline: none; }
        .riva-add-btn { min-height: 3rem; flex: 1 1 13rem; display: inline-flex; align-items: center; justify-content: center; gap: .6rem; padding: 0 1.35rem; border: 1px solid #4d4634; border-radius: 999px; background: #4d4634; color: #fffaf2; font-size: .85rem; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 0 14px 26px rgba(77,70,52,.16); transition: transform .2s ease, background .2s ease; }
        .riva-add-btn:hover { transform: translateY(-2px); background: #2f2a20; }
        .riva-stock { margin-top: .8rem; color: #77664c; font-size: .72rem; font-weight: 900; letter-spacing: .14em; text-transform: uppercase; }
.riva-error { margin-top: .75rem; color: #b42318; font-size: .75rem; font-weight: 800; text-transform: uppercase; }
        .riva-soldout { min-height: 3rem; flex: 1 1 13rem; display: inline-flex; align-items: center; justify-content: center; gap: .6rem; padding: 0 1.35rem; border: 1px dashed #d7c7ad; border-radius: 999px; background: #faf4e8; color: #8a6b3f; font-size: .78rem; font-weight: 900; text-transform: uppercase; letter-spacing: .05em; }
    </style>

<div class="riva-buybox-row" x-data="{ quantity: <?php if ((object) ('quantity') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('quantity'->value()); ?>')<?php echo e('quantity'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('quantity'); ?>')<?php endif; ?>, max: <?php echo e($stock); ?> }">
        <!--[if BLOCK]><![endif]--><?php if($stock > 0): ?>
            <div class="riva-qty">
                <button type="button" @click="if(quantity > 1) quantity--" aria-label="Kurangi jumlah">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /></svg>
                </button>
                <input style="-moz-appearance: textfield;" type="number" x-model.number="quantity" @input="if(quantity < 1) quantity = 1; if(quantity > max) quantity = max" min="1"
                    :max="max" aria-label="Jumlah produk">
                <button type="button" @click="if(quantity < max) quantity++" aria-label="Tambah jumlah">
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14" /><path d="M12 5v14" /></svg>
                </button>
            </div>

            <button wire:click='addCard' type="button" class="riva-add-btn">
                <span wire:loading.remove wire:target="addCard"><?php echo e($label); ?></span>
                <span wire:loading wire:target="addCard" class="inline-flex items-center gap-2">
                    <span class="inline-block size-4 animate-spin rounded-full border-2 border-current border-t-transparent"></span>
                    Menambahkan...
                </span>
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 11 4-7" /><path d="m19 11-4-7" /><path d="M2 11h20" /><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8c.9 0 1.8-.7 2-1.6l1.7-7.4" /></svg>
            </button>
        <?php else: ?>
            <div class="riva-soldout"><?php echo e(__('Stok habis — item ini sedang tidak tersedia.')); ?></div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!--[if BLOCK]><![endif]--><?php if($stock > 0): ?>
        <div class="riva-stock"><?php echo e(__('Stock: :count left', ['count' => $stock])); ?></div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="riva-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/add-to-card.blade.php ENDPATH**/ ?>