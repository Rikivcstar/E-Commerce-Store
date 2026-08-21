<div style="background-color:#eaeae8;color:#111111;padding:2.5rem clamp(1rem,4vw,3.5rem) 5rem;">
    <div style="max-width:92rem;margin:0 auto;">
        
        <div class="mb-10">
            <div class="animate-pulse h-[clamp(3rem,8vw,6rem)] w-64 max-w-full rounded-sm bg-neutral-200/80"></div>
        </div>

        <div class="grid items-start gap-10 grid-cols-1 md:[grid-template-columns:minmax(0,1fr)_28rem]">
            
            <div class="w-full">
                <?php for($s = 0; $s < 3; $s++): ?>
                    <section class="mb-10">
                        <div class="animate-pulse mb-5 h-7 w-48 rounded-sm bg-neutral-200/80"></div>
                        
                        <div class="animate-pulse mb-4 h-4 w-40 rounded-full bg-neutral-200/80"></div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <?php for($i = 0; $i < 4; $i++): ?>
                                <div class="animate-pulse h-12 w-full border border-[#d4d4d0] bg-[#f4f4f2]"></div>
                            <?php endfor; ?>
                        </div>
                    </section>
                <?php endfor; ?>
            </div>

            
            <aside class="animate-pulse" style="position:sticky;top:6rem;">
                <div class="mb-6 flex items-baseline justify-between">
                    <div class="h-7 w-44 rounded-sm bg-neutral-200/80"></div>
                    <div class="h-3.5 w-10 rounded-full bg-neutral-200/80"></div>
                </div>
                <div class="divide-y divide-neutral-300">
                    <?php for($i = 0; $i < 2; $i++): ?>
                        <div class="flex items-center gap-4 py-3">
                            <div class="aspect-[1/1.2] w-16 shrink-0 rounded-sm bg-neutral-200/80"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-3.5 w-3/4 rounded-full bg-neutral-200/80"></div>
                                <div class="h-3 w-1/2 rounded-full bg-neutral-200/80"></div>
                            </div>
                            <div class="h-4 w-16 rounded-full bg-neutral-200/80"></div>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="mt-6 flex gap-2">
                    <div class="h-11 flex-1 border border-[#d4d4d0] bg-[#f4f4f2]"></div>
                    <div class="h-11 w-24 border border-[#d4d4d0] bg-[#d8d8d4]"></div>
                </div>
                <div class="mt-6">
                    <?php if (isset($component)) { $__componentOriginal5efad19ddc2c780f63372f0b9587556f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5efad19ddc2c780f63372f0b9587556f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.checkout-summary','data' => ['rows' => 4]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.checkout-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rows' => 4]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5efad19ddc2c780f63372f0b9587556f)): ?>
<?php $attributes = $__attributesOriginal5efad19ddc2c780f63372f0b9587556f; ?>
<?php unset($__attributesOriginal5efad19ddc2c780f63372f0b9587556f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5efad19ddc2c780f63372f0b9587556f)): ?>
<?php $component = $__componentOriginal5efad19ddc2c780f63372f0b9587556f; ?>
<?php unset($__componentOriginal5efad19ddc2c780f63372f0b9587556f); ?>
<?php endif; ?>
                </div>
                <div class="mt-6 h-14 w-full bg-neutral-200/80"></div>
            </aside>
        </div>
    </div>
</div><?php /**PATH C:\laraherd\webstore\resources\views\livewire\checkout-skeleton.blade.php ENDPATH**/ ?>