<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'count' => 8,
    'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4',
]));

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

foreach (array_filter(([
    'count' => 8,
    'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'animate-pulse grid ' . $grid])); ?> aria-hidden="true">
    <?php for($i = 0; $i < $count; $i++): ?>
        <div class="block">
            <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-neutral-200/80"></div>
            <div class="mt-3 space-y-2 px-0.5">
                <div class="h-3.5 w-3/4 rounded-full bg-neutral-200/80"></div>
                <div class="h-3.5 w-1/2 rounded-full bg-neutral-200/80"></div>
                <div class="h-4 w-1/3 rounded-full bg-neutral-200/80"></div>
            </div>
        </div>
    <?php endfor; ?>
</div><?php /**PATH C:\laraherd\webstore\resources\views\components\skeleton\product-grid.blade.php ENDPATH**/ ?>