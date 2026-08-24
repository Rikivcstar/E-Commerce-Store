<div style="background:#f7f7f2;padding:clamp(1rem,2vw,1.75rem) clamp(1rem,3vw,2.5rem) 4rem;color:#20221b;">
    <div style="max-width:92rem;margin:0 auto;">
        
        <div class="flex items-center gap-2 text-sm">
            <div class="animate-pulse h-3 w-16 rounded-full bg-neutral-200/80"></div>
            <div class="h-3 w-2 bg-neutral-200/80"></div>
            <div class="animate-pulse h-3 w-20 rounded-full bg-neutral-200/80"></div>
            <div class="h-3 w-2 bg-neutral-200/80"></div>
            <div class="animate-pulse h-3 w-28 rounded-full bg-neutral-200/80"></div>
        </div>

        <div class="mt-6 grid gap-5 items-start md:[grid-template-columns:minmax(0,1.22fr)_minmax(24rem,.78fr)]">
            
            <div class="grid gap-4">
                <div class="animate-pulse overflow-hidden rounded-[1.45rem] bg-neutral-200/80" style="aspect-ratio:1/.84;min-height:26rem;max-height:45rem"></div>
                <div class="flex gap-3 px-1">
                    <?php for($i = 0; $i < 3; $i++): ?>
                        <div class="animate-pulse w-1/3 rounded-[.95rem] bg-neutral-200/80" style="aspect-ratio:1.45/1"></div>
                    <?php endfor; ?>
                </div>
            </div>

            
            <aside class="rounded-[1.45rem] bg-white/85 p-6 shadow-[0_18px_45px_rgba(32,34,27,.06)] ring-1 ring-[#e5e2d7] md:[position:sticky] md:top-24">
                <div class="animate-pulse space-y-4">
                    <div class="inline-block rounded-full bg-neutral-200/80 px-4 py-2"><div class="h-3 w-32 rounded-full bg-neutral-300/60"></div></div>
                    <div class="h-3.5 w-36 rounded-full bg-neutral-200/80"></div>
                    <div class="h-[clamp(2.7rem,5.4vw,5.45rem)] w-3/4 rounded-sm bg-neutral-200/80"></div>
                    <div class="h-10 w-48 rounded-sm bg-neutral-200/80"></div>
                    <div class="h-px w-full bg-neutral-200"></div>
                    <div class="flex gap-3">
                        <div class="h-12 flex-1 rounded-full bg-neutral-200/80"></div>
                        <div class="size-12 rounded-full bg-neutral-200/80"></div>
                    </div>
                    <div class="h-px w-full bg-neutral-200"></div>
                    <div class="space-y-3">
                        <?php for($i = 0; $i < 3; $i++): ?>
                            <div class="flex items-center gap-3">
                                <div class="size-5 rounded-full bg-neutral-200/80"></div>
                                <div class="h-3.5 w-2/3 rounded-full bg-neutral-200/80"></div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </aside>
        </div>

        
        <div class="mt-10">
            <div class="animate-pulse mb-4 h-5 w-44 rounded-full bg-neutral-200/80"></div>
            <div class="space-y-3">
                <?php for($i = 0; $i < 2; $i++): ?>
                    <div class="animate-pulse rounded-[1.45rem] bg-white/85 p-5 ring-1 ring-[#e5e2d7]">
                        <div class="flex items-center justify-between">
                            <div class="h-3.5 w-28 rounded-full bg-neutral-200/80"></div>
                            <div class="h-3 w-16 rounded-full bg-neutral-200/80"></div>
                        </div>
                        <div class="mt-3 space-y-2">
                            <div class="h-3 w-full rounded-full bg-neutral-200/80"></div>
                            <div class="h-3 w-2/3 rounded-full bg-neutral-200/80"></div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        
        <div class="mt-14">
            <div class="animate-pulse mx-auto mb-6 h-[clamp(2.4rem,5vw,4.2rem)] w-full max-w-md rounded-sm bg-neutral-200/80"></div>
            <div aria-hidden="true">
                <?php if (isset($component)) { $__componentOriginal4866ec23599bbec6c68be5d2e926152b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4866ec23599bbec6c68be5d2e926152b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.product-grid','data' => ['count' => 4,'grid' => 'grid grid-cols-2 gap-5 sm:grid-cols-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.product-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['count' => 4,'grid' => 'grid grid-cols-2 gap-5 sm:grid-cols-4']); ?>
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
        </div>
    </div>
</div><?php /**PATH C:\laraherd\webstore\resources\views/livewire/product-detail-skeleton.blade.php ENDPATH**/ ?>