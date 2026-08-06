<div>
    <style>
        .cart-page { background: #f7f2e8; padding: 2rem clamp(1rem, 3vw, 2.5rem) 4rem; }
        .cart-shell { max-width: 92rem; margin: 0 auto; }
        .cart-header { margin-bottom: 1.5rem; }
        .cart-kicker { color: #8b7659; font-size: .75rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .cart-title { margin-top: .45rem; color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: clamp(2.6rem, 6vw, 5.5rem); font-weight: 900; line-height: .86; text-transform: uppercase; }
        .cart-grid { display: grid; gap: 1.5rem; align-items: start; }
        .cart-card, .summary-card { border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 1.5rem; box-shadow: 0 18px 45px rgba(79,68,48,.08); }
        .cart-card { display: grid; gap: 1rem; padding: 1rem; margin-bottom: 1rem; }
        .cart-img { width: 8.5rem; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 1.1rem; border: 1px solid #d7c7ad; background: #f3eadc; }
        .cart-item-title { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 1.6rem; font-weight: 900; line-height: 1; text-transform: uppercase; }
        .cart-desc { margin-top: .4rem; color: #77664c; font-size: .95rem; }
        .cart-price { color: #4d4634; font-size: 1.35rem; font-weight: 900; }
        .cart-stock { color: #8b7659; font-size: .72rem; font-weight: 900; letter-spacing: .14em; text-transform: uppercase; }
        .cart-empty { padding: 4rem 1.5rem; text-align: center; color: #77664c; font-size: 1rem; font-weight: 900; text-transform: uppercase; }
        .summary-card { padding: 1.25rem; position: sticky; top: 6rem; }
        .summary-title { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 2rem; font-weight: 900; text-transform: uppercase; }
        .summary-list { margin-top: 1.25rem; border: 1px solid #d7c7ad; border-radius: 1.1rem; overflow: hidden; background: #f8f0e2; }
        .summary-row { display: flex; justify-content: space-between; gap: 1rem; padding: 1rem; color: #5d523f; font-size: .95rem; border-bottom: 1px solid #d7c7ad; }
        .summary-row:last-child { border-bottom: 0; background: #fffaf2; color: #211b14; font-weight: 900; }
        .summary-row strong { color: #4d4634; }
        .checkout-btn { margin-top: 1rem; width: 100%; height: 3.25rem; border: 0; border-radius: 999px; background: #4d4634; color: #fffaf2; font-size: .9rem; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 0 14px 26px rgba(77,70,52,.16); transition: .2s ease; }
        .checkout-btn:hover { transform: translateY(-2px); background: #2f2a20; }
        @media (min-width: 760px) { .cart-card { grid-template-columns: auto 1fr auto; align-items: center; padding: 1.25rem; } }
        @media (min-width: 980px) { .cart-grid { grid-template-columns: minmax(0, 1fr) 28rem; } }
    </style>

    <div class="cart-page">
        <div class="cart-shell">
            <div class="cart-header">
                <p class="cart-kicker">Shopping bag</p>
                <h1 class="cart-title">Your selected items.</h1>
            </div>

            <div class="cart-grid">
                <section>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <article class="cart-card">
                            <img class="cart-img" src="<?php echo e($item->product()->cover_url); ?>" alt="<?php echo e($item->sku); ?>">
                            <div>
                                <h3 class="cart-item-title"><?php echo e($item->product()->name); ?></h3>
                                <p class="cart-desc"><?php echo e($item->product()->short_desc); ?></p>
                                <div class="mt-4 max-w-md">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-to-card', ['product' => $item->product()]);

$__html = app('livewire')->mount($__name, $__params, 'add-to-cart-'.e($item->sku).'', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                </div>
                                <p class="cart-stock">Stock: <?php echo e($item->product()->stock); ?> left</p>
                            </div>
                            <div class="flex items-center justify-between gap-4 md:flex-col md:items-end">
                                <p class="cart-price"><?php echo e($item->product()->price_formatted); ?></p>
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('cart-remove', ['product' => $item->product()]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2747142257-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="cart-card cart-empty">Your cart is empty</div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </section>

                <aside class="summary-card">
                    <h2 class="summary-title">Order summary</h2>
                    <div class="summary-list">
                        <div class="summary-row"><span>Sub total</span><strong><?php echo e($subTotal); ?></strong></div>
                        <div class="summary-row"><span>Shipping</span><strong>Free</strong></div>
                        <div class="summary-row"><span>Total</span><strong><?php echo e($total); ?></strong></div>
                    </div>
                    <button type="button" wire:click='checkout' wire:loading.attr='disabled' class="checkout-btn">
                        Checkout now
                        <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>
                    </button>
                </aside>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/cart.blade.php ENDPATH**/ ?>