<div>
    <?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Wishlist']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Wishlist']); ?>
        <style>
            .wishlist-page {
                max-width: 92rem;
                margin: 0 auto;
                padding: clamp(1rem, 3vw, 2.5rem) clamp(1rem, 3vw, 2.5rem) 4rem;
            }
            .wishlist-title {
                color: #20221b;
                font-family: Finlandica, Inter, sans-serif;
                font-size: clamp(2.2rem, 5vw, 4rem);
                font-weight: 900;
                line-height: .9;
                text-transform: uppercase;
            }
            .wishlist-subtitle {
                margin-top: .6rem;
                color: #8b8f82;
                font-size: .9rem;
                font-weight: 700;
            }
            .wishlist-grid {
                margin-top: 1.75rem;
                display: grid;
                gap: 1.1rem;
                grid-template-columns: repeat(auto-fill, minmax(16rem, 1fr));
            }
            .wish-card {
                position: relative;
                display: block;
                overflow: hidden;
                padding: .6rem;
                border: 1px solid #e5e2d7;
                background: rgba(255,255,255,.9);
                border-radius: 1.3rem;
                color: inherit;
                text-decoration: none;
                transition: transform .25s ease, box-shadow .25s ease;
            }
            .wish-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 24px 48px rgba(32,34,27,.1);
            }
            .wish-media {
                overflow: hidden;
                border-radius: 1rem;
                background: #eff0ea;
                aspect-ratio: 1.08 / 1;
            }
            .wish-media img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform .7s ease;
            }
            .wish-card:hover .wish-media img {
                transform: scale(1.05);
            }
            .wish-remove {
                position: absolute;
                top: 1.1rem;
                right: 1.1rem;
                z-index: 2;
                background: rgba(255,255,255,.95);
                box-shadow: 0 10px 24px rgba(32,34,27,.14);
            }
            .wish-info {
                padding: .9rem .3rem .45rem;
            }
            .wish-name {
                min-height: 2.35rem;
                color: #20221b;
                font-size: .92rem;
                font-weight: 900;
                line-height: 1.25;
                text-transform: uppercase;
            }
            .wish-row {
                margin-top: .65rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: .75rem;
            }
            .wish-price {
                color: #20221b;
                font-size: .9rem;
                font-weight: 900;
            }
            .wish-empty {
                margin-top: 2rem;
                padding: 2.5rem;
                text-align: center;
                border: 1px dashed #d7cfbf;
                border-radius: 1.3rem;
                color: #8b8f82;
                background: rgba(255,255,255,.6);
            }
            .wish-empty a {
                display: inline-flex;
                margin-top: 1rem;
                padding: .75rem 1.5rem;
                border-radius: 999px;
                background: #4d4634;
                color: #fffaf2;
                font-weight: 900;
                text-decoration: none;
            }
        </style>

        <div class="wishlist-page">
            <h1 class="wishlist-title">Wishlist</h1>
            <p class="wishlist-subtitle">Produk yang Anda simpan untuk dibeli nanti.</p>

            <!--[if BLOCK]><![endif]--><?php if($items->isEmpty()): ?>
                <div class="wish-empty">
                    <p>Wishlist Anda masih kosong.</p>
                    <a href="<?php echo e(route('product-catalog')); ?>">Jelajahi Produk</a>
                </div>
            <?php else: ?>
                <div class="wishlist-grid">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="wish-card" href="<?php echo e(route('product', $item->slug)); ?>">
                            <div class="wish-remove">
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wishlist-remove', ['product' => $item]);

$__html = app('livewire')->mount($__name, $__params, 'wish-'.e($item->sku).'', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            </div>
                            <div class="wish-media">
                                <img src="<?php echo e($item->cover_url); ?>" alt="<?php echo e($item->name); ?>" loading="lazy">
                            </div>
                            <div class="wish-info">
                                <h3 class="wish-name"><?php echo e($item->name); ?></h3>
                                <div class="wish-row">
                                    <p class="wish-price"><?php echo e($item->price_formatted); ?></p>
                                    <span class="text-xs font-black text-zinc-400"><?php echo e($item->sku); ?></span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
</div><?php /**PATH C:\laraherd\webstore\resources\views/livewire/wishlist.blade.php ENDPATH**/ ?>