<div>
    
    <section class="nx-skeleton-hero w-full" style="background:#F7F5EF;padding-top:5rem;min-height:calc(100vh - 5rem)">
        <div class="animate-pulse flex h-full flex-col items-center justify-center gap-6 px-6 text-center">
            <div class="h-4 w-40 rounded-full bg-neutral-200/80"></div>
            <div class="h-[clamp(4.5rem,17vw,15.5rem)] w-[80%] rounded-sm bg-neutral-200/80"
                style="line-height:.82"></div>
            <div class="h-4 w-52 rounded-full bg-neutral-200/80"></div>
            <div class="flex gap-4">
                <div class="h-12 w-40 rounded-sm bg-neutral-200/80"></div>
                <div class="h-12 w-40 rounded-sm border border-neutral-200 bg-transparent"></div>
            </div>
        </div>
    </section>

    
    <section class="w-full py-6" style="background:#111008">
        <div class="mx-auto max-w-7xl animate-pulse px-4 sm:px-8 lg:px-16">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <?php for($i = 0; $i < 3; $i++): ?>
                    <div class="flex items-center gap-5 px-2 py-3 sm:px-6">
                        <div class="h-20 w-16 shrink-0 rounded-sm bg-neutral-700"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 w-2/3 rounded-full bg-neutral-700"></div>
                            <div class="h-3 w-1/2 rounded-full bg-neutral-700"></div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    
    <section class="w-full px-4 py-16 sm:px-8 lg:px-16" style="background:#F7F5EF">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between">
                <div class="h-8 w-56 animate-pulse rounded-full bg-neutral-200/80" style="background:#E1DDD1"></div>
                <div class="h-4 w-20 animate-pulse rounded-full bg-neutral-200/80" style="background:#E1DDD1"></div>
            </div>
            <?php if (isset($component)) { $__componentOriginal4866ec23599bbec6c68be5d2e926152b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4866ec23599bbec6c68be5d2e926152b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.product-grid','data' => ['count' => 8,'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 8,'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4866ec23599bbec6c68be5d2e926152b)): ?>
<?php $attributes = $__attributesOriginal4866ec23599bbec6c68be5d2e926152b; ?>
<?php unset($__attributesOriginal4866ec23599bbec6c68be5d2e926152b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4866ec23599bbec6c68be5d2e926152b)): ?>
<?php $component = $__componentOriginal4866ec23599bbec6c68be5d2e926152b; ?>
<?php unset($__componentOriginal4866ec23599bbec6c68be5d2e926152b); ?>
<?php endif; ?>
        </div>
    </section>

    
    <section class="w-full px-4 py-16 sm:px-8 lg:px-16" style="background:#F7F5EF">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between">
                <div class="h-8 w-48 animate-pulse rounded-full bg-neutral-200/80" style="background:#E1DDD1"></div>
                <div class="h-4 w-20 animate-pulse rounded-full bg-neutral-200/80" style="background:#E1DDD1"></div>
            </div>
            <?php if (isset($component)) { $__componentOriginal4866ec23599bbec6c68be5d2e926152b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4866ec23599bbec6c68be5d2e926152b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.product-grid','data' => ['count' => 4,'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 4,'grid' => 'grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4866ec23599bbec6c68be5d2e926152b)): ?>
<?php $attributes = $__attributesOriginal4866ec23599bbec6c68be5d2e926152b; ?>
<?php unset($__attributesOriginal4866ec23599bbec6c68be5d2e926152b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4866ec23599bbec6c68be5d2e926152b)): ?>
<?php $component = $__componentOriginal4866ec23599bbec6c68be5d2e926152b; ?>
<?php unset($__componentOriginal4866ec23599bbec6c68be5d2e926152b); ?>
<?php endif; ?>
        </div>
    </section>
</div><?php /**PATH C:\laraherd\webstore\resources\views\livewire\home-page-skeleton.blade.php ENDPATH**/ ?>