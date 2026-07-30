<?php if (isset($component)) { $__componentOriginald2aa9f7b74553621bdcc3c69267ff328 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald2aa9f7b74553621bdcc3c69267ff328 = $attributes; } ?>
<?php $component = Filament\View\LegacyComponents\PageComponent::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Filament\View\LegacyComponents\PageComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="divide-y divide-gray-900/10 dark:divide-white/10 [&>*:not(:first-child)]:pt-6 [&>*:not(:last-child)]:pb-6">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->getRegisteredMyProfileComponents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--[if BLOCK]><![endif]--><?php if (! (is_null($component))): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split($component);

$__html = app('livewire')->mount($__name, $__params, 'lw-2834605510-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald2aa9f7b74553621bdcc3c69267ff328)): ?>
<?php $attributes = $__attributesOriginald2aa9f7b74553621bdcc3c69267ff328; ?>
<?php unset($__attributesOriginald2aa9f7b74553621bdcc3c69267ff328); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald2aa9f7b74553621bdcc3c69267ff328)): ?>
<?php $component = $__componentOriginald2aa9f7b74553621bdcc3c69267ff328; ?>
<?php unset($__componentOriginald2aa9f7b74553621bdcc3c69267ff328); ?>
<?php endif; ?>
<?php /**PATH C:\laraherd\webstore\vendor\jeffgreco13\filament-breezy\resources\views/filament/pages/my-profile.blade.php ENDPATH**/ ?>