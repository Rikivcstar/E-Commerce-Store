<div
    class="group relative flex flex-col overflow-hidden rounded-2xl bg-white p-3 shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-md">
    <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-zinc-100">
        <a href="<?php echo e(route('product', $product->slug)); ?>" class="block h-full w-full">
            <img src="<?php echo e($product->cover_url); ?>" alt="<?php echo e($product->name); ?>"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
        </a>

        <!--[if BLOCK]><![endif]--><?php if(isset($product->stock) && $product->stock <= 3 && $product->stock > 0): ?>
            <span class="absolute left-2 top-2 z-10 rounded-md bg-rose-600/90 px-2 py-0.5 text-[10px] font-bold text-white shadow-xs backdrop-blur-md uppercase tracking-wider">
                Stok Terbatas
            </span>
        <?php elseif(isset($product->stock) && $product->stock == 0): ?>
            <span class="absolute left-2 top-2 z-10 rounded-md bg-zinc-900/90 px-2 py-0.5 text-[10px] font-bold text-white shadow-xs backdrop-blur-md uppercase tracking-wider">
                Stok Habis
            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="absolute right-2.5 top-2.5 z-10">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wishlist-toggle', ['product' => $product,'variant' => 'icon']);

$__html = app('livewire')->mount($__name, $__params, 'card-wish-'.e($product->sku).'', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>

    <div class="mt-2.5 flex flex-1 flex-col justify-between space-y-2 px-0.5">
        <div>
            <?php
                $collectionName = !empty($product->collection) 
                    ? $product->collection 
                    : (!empty($product->short_desc) ? $product->short_desc : 'Curated Goods');
            ?>
            <p class="text-[10px] font-extrabold uppercase tracking-widest text-[#777c62] mb-0.5 line-clamp-1">
                <?php echo e($collectionName); ?>

            </p>

            <a href="<?php echo e(route('product', $product->slug)); ?>" class="focus:outline-none">
                <h3 class="text-sm font-bold leading-snug text-zinc-900 transition group-hover:text-[#555a42] line-clamp-2">
                    <?php echo e($product->name); ?>

                </h3>
            </a>
        </div>

        <div class="pt-0.5 space-y-1">
            <p class="text-sm sm:text-base font-black text-zinc-900"><?php echo e($product->price_formatted); ?></p>

            <div class="flex items-center gap-1.5 text-xs text-zinc-500 font-medium">
                <span class="inline-flex items-center gap-1 font-bold text-zinc-800">
                    <svg class="size-3.5 fill-amber-400 text-amber-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                    4.8
                </span>
                <span class="text-zinc-300">•</span>
                <span class="text-zinc-500">
                    <?php
                        $sold = isset($product->sold_count) && $product->sold_count > 0 
                            ? $product->sold_count 
                            : (isset($product->id) ? (($product->id * 17) % 75 + 15) : 25);
                    ?>
                    Terjual <?php echo e($sold); ?>+
                </span>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\laraherd\webstore\resources\views/components/single-product-card.blade.php ENDPATH**/ ?>