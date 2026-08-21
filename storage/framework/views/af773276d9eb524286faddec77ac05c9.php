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

            <?php if($items->isEmpty()): ?>
                <div class="wish-empty">
                    <p>Wishlist Anda masih kosong.</p>
                    <a href="<?php echo e(route('product-catalog')); ?>">Jelajahi Produk</a>
                </div>
            <?php else: ?>
                <div class="wishlist-grid">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="wish-card">
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
                            <a href="<?php echo e(route('product', $item->slug)); ?>" class="block">
                                <div class="wish-media">
                                    <img src="<?php echo e($item->cover_url); ?>" alt="<?php echo e($item->name); ?>" loading="lazy">
                                </div>
                                <div class="wish-info">
                                    <h3 class="wish-name"><?php echo e($item->name); ?></h3>
                                </div>
                            </a>
                            <div class="wish-info" style="padding-top:0;">
                                <div class="wish-row">
                                    <p class="wish-price"><?php echo e($item->price_formatted); ?></p>
                                    <span class="text-xs font-black text-zinc-400"><?php echo e($item->sku); ?></span>
                                </div>
                                <button type="button" wire:click="addToCart('<?php echo e($item->sku); ?>')"
                                    wire:loading.attr="disabled"
                                    class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-full border border-[#4d4634] bg-[#4d4634] px-4 py-2 text-[.75rem] font-black uppercase tracking-wider text-[#fffaf2] transition hover:bg-[#2f2a20] cursor-pointer">
                                    <span wire:loading.remove wire:target="addToCart('<?php echo e($item->sku); ?>')">
                                        <svg class="inline size-3.5 -mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 11 4-7"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8c.9 0 1.8-.7 2-1.6l1.7-7.4"/></svg>
                                        Tambah ke Keranjang
                                    </span>
                                    <span wire:loading wire:target="addToCart('<?php echo e($item->sku); ?>')"
                                        class="inline-flex items-center gap-2">
                                        <span class="inline-block size-3.5 animate-spin rounded-full border-2 border-current border-t-transparent"></span>
                                        Menambahkan...
                                    </span>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
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
</div><?php /**PATH C:\laraherd\webstore\resources\views\livewire\wishlist.blade.php ENDPATH**/ ?>