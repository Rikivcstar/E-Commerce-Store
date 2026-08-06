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
    <style>
        .product-page { background: #f7f2e8; padding: 2rem clamp(1rem, 3vw, 2.5rem) 4rem; }
        .product-shell { max-width: 92rem; margin: 0 auto; }
        .product-kicker { color: #8b7659; font-size: .75rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .product-grid { display: grid; gap: 1.5rem; align-items: start; }
        .product-media-card, .product-info-card, .product-desc-card { border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 1.6rem; box-shadow: 0 18px 45px rgba(79, 68, 48, .08); overflow: hidden; }
        .product-main-image { width: 100%; aspect-ratio: 1.18 / 1; object-fit: cover; background: #efe3cf; display: block; }
        .product-thumbs { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: .75rem; padding: .75rem; background: #f3eadc; border-top: 1px solid #d7c7ad; }
        .product-thumbs img { width: 100%; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 1rem; border: 1px solid #d7c7ad; background: #fffaf2; }
        .product-info-card { padding: clamp(1.25rem, 3vw, 2rem); position: sticky; top: 6rem; }
        .product-title { margin-top: .55rem; color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: clamp(2.4rem, 5vw, 4.8rem); font-weight: 900; line-height: .9; letter-spacing: 0; text-transform: uppercase; }
        .product-short { margin-top: 1rem; color: #6c5d48; font-size: 1rem; line-height: 1.7; }
        .product-price { display: block; margin-top: 1.4rem; color: #4d4634; font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 900; }
        .product-divider { height: 1px; background: #d7c7ad; margin: 1.6rem 0; }
        .product-desc-card { margin-top: 1.5rem; padding: clamp(1.25rem, 3vw, 2rem); }
        .product-desc-card h2 { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 1.75rem; font-weight: 900; text-transform: uppercase; }
        .product-desc { margin-top: 1rem; color: #5d523f; font-size: 1rem; line-height: 1.8; }
        @media (min-width: 980px) { .product-grid { grid-template-columns: minmax(0, 1.35fr) minmax(22rem, .65fr); } }
    </style>

    <div class="product-page">
        <div class="product-shell">
            <div class="product-grid">
                <div>
                    <div class="product-media-card" data-aos="fade-right">
                        <img src="<?php echo e($product->cover_url); ?>" alt="<?php echo e($product->name); ?>" class="product-main-image">
                        <?php if($product->gallery && count($product->gallery) > 0): ?>
                            <div class="product-thumbs">
                                <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e($image); ?>" alt="image-<?php echo e($key); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="product-desc-card">
                        <p class="product-kicker">Product notes</p>
                        <h2>Description</h2>
                        <div class="product-desc prose max-w-none">
                            <?php echo Str::markDown($product->description); ?>

                        </div>
                    </div>
                </div>

                <aside class="product-info-card" data-aos="fade-left">
                    <p class="product-kicker"><?php echo e($product->sku); ?></p>
                    <h1 class="product-title"><?php echo e($product->name); ?></h1>
                    <p class="product-short"><?php echo e($product->short_desc); ?></p>
                    <span class="product-price"><?php echo e($product->price_formatted); ?></span>
                    <div class="product-divider"></div>
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
                    <div class="product-divider"></div>
                    <div class="grid gap-3 text-sm font-bold text-[#5d523f]">
                        <span>Original curated item</span>
                        <span>Checkout cepat dan aman</span>
                        <span>Support setelah pembelian</span>
                    </div>
                </aside>
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