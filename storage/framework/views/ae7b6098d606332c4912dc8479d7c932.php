<div <?php if($autoPrompt): ?> wire:init="authenticateWithPasskey" <?php endif; ?>>
    <?php if(\Filament\Facades\Filament::getCurrentOrDefaultPanel()?->hasPlugin('filament-breezy')): ?>
        <div>
            <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['class' => 'w-full','color' => 'gray','wire:click' => 'authenticateWithPasskey']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full','color' => 'gray','wire:click' => 'authenticateWithPasskey']); ?>
                <?php echo e(__('filament-breezy::default.passkeys.authenticate_using_passkey.label')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>

            <?php if($message = session()->get('authenticatePasskey::message')): ?>
                <div class="mt-2 text-sm text-danger-600">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
        </div>

        <?php echo $__env->make('filament-breezy::livewire.passkeys.authenticate-script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</div>
<?php /**PATH C:\laraherd\webstore\vendor\jeffgreco13\filament-breezy\resources\views\livewire\passkey-action.blade.php ENDPATH**/ ?>