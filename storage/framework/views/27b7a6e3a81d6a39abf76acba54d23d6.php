<div class="bg-[#f7f7f2] px-3 pb-14 pt-6 text-[#20221b] sm:px-5 lg:px-8">
    <div class="mx-auto max-w-[92rem]">
        
        <div class="relative mb-6 overflow-hidden rounded-[1.5rem] shadow-sm">
            <div class="h-44 w-full sm:h-56 md:h-64 lg:h-72">
                <div class="animate-pulse h-full w-full bg-neutral-200/80">
                    <div class="flex h-full items-center px-6 sm:px-10">
                        <div class="max-w-md space-y-4">
                            <div class="h-3.5 w-24 rounded-full bg-neutral-300/70"></div>
                            <div class="h-12 w-72 max-w-full rounded-sm bg-neutral-300/70 sm:h-16"></div>
                            <div class="h-6 w-40 rounded-full bg-neutral-300/70"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[20rem_1fr]">
            <aside class="rounded-[1.5rem] bg-white p-5 shadow-sm ring-1 ring-black/5">
                <div class="animate-pulse space-y-4">
                    <div class="h-12 rounded-full bg-neutral-200/80"></div>
                    <div class="pt-4">
                        <div class="h-4 w-28 rounded-full bg-neutral-200/80"></div>
                        <div class="mt-4 space-y-3">
                            <?php for($i = 0; $i < 5; $i++): ?>
                                <div class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="size-4 rounded-sm bg-neutral-200/80"></div>
                                        <div class="h-3.5 w-28 rounded-full bg-neutral-200/80"></div>
                                    </div>
                                    <div class="h-3 w-6 rounded-full bg-neutral-200/80"></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="h-4 w-32 rounded-full bg-neutral-200/80"></div>
                        <div class="mt-4 space-y-3">
                            <?php for($i = 0; $i < 3; $i++): ?>
                                <div class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="size-4 rounded-sm bg-neutral-200/80"></div>
                                        <div class="h-3.5 w-24 rounded-full bg-neutral-200/80"></div>
                                    </div>
                                    <div class="h-3 w-6 rounded-full bg-neutral-200/80"></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-4">
                        <div class="h-11 rounded-full bg-neutral-200/80"></div>
                        <div class="h-11 rounded-full bg-neutral-200/80"></div>
                    </div>
                </div>
            </aside>

            <section>
                <div class="mb-5 rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-black/5">
                    <div class="animate-pulse flex gap-2">
                        <?php for($i = 0; $i < 4; $i++): ?>
                            <div class="h-10 w-24 rounded-full bg-neutral-200/80"></div>
                        <?php endfor; ?>
                    </div>
                </div>

                <div aria-hidden="true">
                    <?php if (isset($component)) { $__componentOriginal4866ec23599bbec6c68be5d2e926152b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4866ec23599bbec6c68be5d2e926152b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.product-grid','data' => ['count' => 12,'grid' => 'grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 12,'grid' => 'grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4']); ?>
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
        </div>
    </div>
</div><?php /**PATH C:\laraherd\webstore\resources\views/livewire/product-catalog-skeleton.blade.php ENDPATH**/ ?>