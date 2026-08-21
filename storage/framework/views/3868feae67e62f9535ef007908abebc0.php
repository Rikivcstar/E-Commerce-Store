<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['cart_item']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['cart_item']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="flex items-start gap-4 py-3 border-b border-neutral-200/80 last:border-b-0">
    <div class="relative h-20 w-16 flex-shrink-0 overflow-hidden bg-neutral-100 border border-neutral-200">
        <img class="size-full object-cover" src="<?php echo e($cart_item->product()->cover_url); ?>" alt="<?php echo e($cart_item->product()->name); ?>">
    </div>
    <div class="min-w-0 flex-grow pt-0.5">
        <h3 class="font-display text-xs font-bold uppercase tracking-tight text-neutral-900 leading-tight"><?php echo e($cart_item->product()->name); ?></h3>
        <?php if($cart_item->product()->short_desc): ?>
            <p class="mt-1 text-[11px] text-neutral-500 line-clamp-1 leading-snug"><?php echo e($cart_item->product()->short_desc); ?></p>
        <?php endif; ?>
        <div class="mt-2 text-[11px] text-neutral-500 font-medium space-y-0.5">
            <p>Quantity: <span class="text-neutral-900 font-bold"><?php echo e($cart_item->quantity); ?></span></p>
        </div>
    </div>
    <div class="text-right flex-shrink-0 pt-0.5">
        <p class="text-xs font-bold text-neutral-900 tracking-tight"><?php echo e($cart_item->product()->price_formatted); ?></p>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views\components\single-product-list.blade.php ENDPATH**/ ?>