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
<div class="flex items-center gap-3 py-1">
    <div class="relative h-16 w-16 flex-shrink-0 overflow-hidden rounded-2xl border border-[#d7c7ad] bg-[#f4ead9]">
        <img class="size-full object-cover" src="<?php echo e($cart_item->product()->cover_url); ?>" alt="<?php echo e($cart_item->product()->name); ?>">
    </div>
    <div class="min-w-0 flex-grow">
        <h3 class="truncate text-sm font-black text-[#211b14]"><?php echo e($cart_item->product()->name); ?></h3>
        <p class="mt-0.5 truncate text-xs text-[#77664c]"><?php echo e($cart_item->product()->short_desc); ?></p>
        <p class="mt-1 text-xs font-black text-[#4d4634]"><?php echo e($cart_item->product()->price_formatted); ?> <span class="font-medium text-[#8a7a61]">x <?php echo e($cart_item->quantity); ?></span></p>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/components/single-product-list.blade.php ENDPATH**/ ?>