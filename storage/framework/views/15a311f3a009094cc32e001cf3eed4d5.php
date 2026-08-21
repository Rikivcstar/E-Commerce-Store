<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'rows' => 4,
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
    'rows' => 4,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'animate-pulse'])); ?> aria-hidden="true">
    <div class="space-y-3">
        <?php for($i = 0; $i < $rows; $i++): ?>
            <div class="flex items-center justify-between">
                <div class="h-3.5 w-24 rounded-full bg-neutral-200/80"></div>
                <div class="h-3.5 w-16 rounded-full bg-neutral-200/80"></div>
            </div>
        <?php endfor; ?>
        <div class="border-t border-neutral-300 pt-3">
            <div class="flex items-center justify-between">
                <div class="h-4 w-20 rounded-full bg-neutral-200/80"></div>
                <div class="h-5 w-24 rounded-full bg-neutral-200/80"></div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\laraherd\webstore\resources\views\components\skeleton\checkout-summary.blade.php ENDPATH**/ ?>