<a href="<?php echo e(route('product', $product->slug)); ?>"
    class="group block overflow-hidden rounded-[1.25rem] bg-white p-2 shadow-sm ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#555a42]/10"
    data-aos="fade-up"
    data-aos-delay="40"
    data-aos-duration="450">
    <div class="relative aspect-[1.18/1] overflow-hidden rounded-[1rem] bg-[#f1f2ec]">
        <img class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
            src="<?php echo e($product->cover_url); ?>"
            alt="<?php echo e($product->name); ?>">
        <div class="absolute inset-x-3 top-3 flex items-start justify-between gap-2">
            <span class="rounded-full bg-white/88 px-3 py-1 text-[10px] font-black uppercase tracking-[0.08em] text-[#686d55] shadow-sm backdrop-blur">
                <?php echo e($product->short_desc ?? 'Collection'); ?>

            </span>
            <span class="flex size-8 items-center justify-center rounded-full bg-white/88 text-[#555a42] shadow-sm backdrop-blur transition group-hover:bg-[#555a42] group-hover:text-white">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                </svg>
            </span>
        </div>
    </div>
    <div class="px-2 pb-3 pt-4">
        <h3 class="min-h-10 text-sm font-black uppercase leading-5 text-[#20221b] transition group-hover:text-[#555a42] line-clamp-2">
            <?php echo e($product->name); ?>

        </h3>
        <div class="mt-3 flex items-center justify-between gap-2">
            <p class="text-sm font-black text-[#20221b]">
                <?php echo e($product->price_formatted); ?>

            </p>
            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#777c62]">
                4.8
                <svg class="size-3 fill-[#c9a24b] text-[#c9a24b]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2Z" />
                </svg>
            </span>
        </div>
    </div>
</a>
<?php /**PATH C:\laraherd\webstore\resources\views/components/single-product-card.blade.php ENDPATH**/ ?>