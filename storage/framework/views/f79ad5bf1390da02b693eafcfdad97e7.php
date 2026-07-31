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
    <div class="relative overflow-hidden rounded-lg h-14 w-14 border border-[#e2e8f0] flex-shrink-0">
        <img class="object-cover size-full"
            src="<?php echo e($cart_item->product()->cover_url); ?>"
            alt="<?php echo e($cart_item->product()->name); ?>">
    </div>
    <div class="flex-grow">
        <h3 class="text-[#0f2d5a] text-sm font-semibold leading-tight">
            <?php echo e($cart_item->product()->name); ?>

        </h3>
        <p class="text-xs text-[#4b6489] mt-0.5"><?php echo e($cart_item->product()->short_desc); ?></p>
        <p class="mt-1 text-xs font-bold text-[#1e40af]">
            <?php echo e($cart_item->product()->price_formatted); ?> <span class="text-[#4b6489] font-normal">x <?php echo e($cart_item->quantity); ?></span>
        </p>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/components/single-product-list.blade.php ENDPATH**/ ?>