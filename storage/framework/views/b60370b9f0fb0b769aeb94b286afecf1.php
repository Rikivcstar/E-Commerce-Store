<a href="<?php echo e(route('product', $product->slug)); ?>"
    class="group block bg-white rounded-xl overflow-hidden border border-[#e2e8f0] hover:border-[#1e40af]/30 transition-all duration-500 hover:shadow-xl hover:shadow-[#0f2d5a]/[0.08] hover:-translate-y-1"
    data-aos="fade-up"
    data-aos-delay="50"
    data-aos-duration="500">
    <div class="relative overflow-hidden aspect-square">
        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
            src="<?php echo e($product->cover_url); ?>"
            alt="<?php echo e($product->name); ?>">
        <div class="absolute inset-0 bg-[#0f2d5a]/0 group-hover:bg-[#0f2d5a]/25 transition-colors duration-500"></div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-[#1e40af] text-white px-5 py-2 rounded-full translate-y-4 group-hover:translate-y-0 transition-all duration-500 shadow-lg">
                Quick View
            </span>
        </div>
    </div>
    <div class="p-4">
        <span class="text-[10px] text-[#4b6489] uppercase tracking-widest font-medium"><?php echo e($product->short_desc ?? 'Collection'); ?></span>
        <h3 class="mt-1.5 text-sm font-semibold text-[#0f2d5a] group-hover:text-[#1e40af] transition-colors duration-300 leading-snug line-clamp-2">
            <?php echo e($product->name); ?>

        </h3>
        <p class="mt-2.5 text-sm font-bold text-[#1e40af]">
            <?php echo e($product->price_formatted); ?>

        </p>
    </div>
</a>
<?php /**PATH C:\laraherd\webstore\resources\views/components/single-product-card.blade.php ENDPATH**/ ?>