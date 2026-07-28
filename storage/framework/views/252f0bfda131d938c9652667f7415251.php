<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 my-5 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-2 md:col-span-7" data-aos="fade-right">
                <div class="w-full">
                    <img src="<?php echo e($product->cover_url); ?>"
                        alt="<?php echo e($product->name); ?>" class="object-cover w-full rounded-md aspect-3/2 md:col-span-3 shadow-xs">

                    <div class="grid grid-cols-1 gap-3 my-4 md:grid-cols-3 md:col-span-7">
                     <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e($image); ?>"
                            alt="image-<?php echo e($key); ?>" class="object-cover rounded-md aspect-square shadow-xs hover:scale-102 transition-transform duration-200" />
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 flex flex-col gap-6" data-aos="fade-left">
                <div class="flex flex-col gap-2">
                    <div>
                        <span class="inline-block text-xs font-semibold text-[#1e40af] tracking-[0.1em] uppercase mb-1">
                            <?php echo e($product->sku); ?>

                        </span>
                        <h1 class="text-3xl text-[#0f2d5a] font-extrabold tracking-tight leading-tight"><?php echo e($product->name); ?></h1>
                        <p class="text-sm text-[#4b6489] mt-2 font-medium"><?php echo e($product->short_desc); ?></p>
                    </div>
                    <span class="mt-4 text-2xl text-[#1e40af] font-black"><?php echo e($product->price_formatted); ?></span>
                </div>
                
                <div class="border-t border-[#e2e8f0] pt-4">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('add-to-card', ['product' => $product]);

$__html = app('livewire')->mount($__name, $__params, 'lw-336815477-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>

                <div class="border-t border-[#e2e8f0] pt-6">
                    <h3 class="font-bold text-[#0f2d5a] text-lg mb-2">Description</h3>
                    <div class="my-2 prose text-[#4b6489] leading-relaxed">
                        <?php echo Str::markDown($product->description); ?>

                    </div>
                </div>
            </div>
            <div class="md:col-span-10">
                
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\laraherd\webstore\resources\views/product/show.blade.php ENDPATH**/ ?>