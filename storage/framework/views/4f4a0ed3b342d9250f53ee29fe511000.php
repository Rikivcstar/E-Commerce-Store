<div class="bg-[#f7f7f2] px-3 pb-14 pt-6 text-[#20221b] sm:px-5 lg:px-8">
    <div class="mx-auto max-w-[92rem]">
        
        <div class="relative mb-6 overflow-hidden rounded-[1.5rem] shadow-sm">
            <img src="<?php echo e(asset('images/catalog-banner.png')); ?>" alt="Catalog Banner"
                class="h-44 w-full object-cover object-right sm:h-56 sm:object-center md:h-64 lg:h-72">
            <div class="absolute inset-0 flex items-center bg-gradient-to-r from-[#f7f4ed] via-[#f7f4ed]/85 to-transparent p-6 sm:p-10">
                <div class="max-w-md">
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-[#777c62]">Catalog</p>
                    <h1 class="mt-2 font-display text-3xl font-black uppercase leading-none text-[#20221b] sm:text-4xl lg:text-5xl">
                        Temukan produk favoritmu
                    </h1>
<div class="mt-4 inline-flex items-center gap-2 rounded-xl bg-white/80 px-3.5 py-1.5 ring-1 ring-black/5 backdrop-blur-sm">
                        <span wire:loading.remove class="text-xs font-medium text-[#686c60]">Result: <span class="font-black text-[#20221b]"><?php echo e(($products) ? $products->total() : '0'); ?></span> items</span>
                        <span wire:loading class="inline-flex items-center gap-2 text-xs font-medium text-[#686c60]">
                            Result:
                            <span class="inline-block h-3.5 w-10 animate-pulse rounded-full bg-neutral-200/80"></span>
                            items
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[20rem_1fr]">
            <aside class="rounded-[1.5rem] bg-white p-5 shadow-sm ring-1 ring-black/5 lg:sticky lg:top-24 lg:self-start">
                <div class="space-y-3">
                    <label class="relative block">
                        <svg class="pointer-events-none absolute left-4 top-1/2 size-5 -translate-y-1/2 text-[#8c9082]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34" /><circle cx="11" cy="11" r="8" />
                        </svg>
                        <input wire:model.live.debounce.250ms='search' type="text" placeholder="Search product"
                            class="<?php $__errorArgs = ['search'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> h-12 w-full rounded-full border-0 bg-[#f2f3ed] pl-12 pr-4 text-sm text-[#20221b] placeholder:text-[#8c9082] focus:ring-2 focus:ring-[#777c62]/30">
                    </label>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['search'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs font-semibold text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

<div class="mt-7">
                    <span class="block text-sm font-black uppercase text-[#20221b]">Categories</span>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectCategory.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="mt-3 text-xs font-semibold text-red-600"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="mt-4 space-y-3">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                <div class="flex items-center">
                                    <input wire:model='selectCategory' value="<?php echo e($category->id); ?>" type="checkbox"
                                        class="shrink-0 border-[#c9ccbd] bg-white text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42] checked:border-[#555a42]"
                                        id="category-<?php echo e($category->id); ?>">
                                    <label for="category-<?php echo e($category->id); ?>" class="ms-3 text-sm font-bold text-[#555a42]">
                                        <?php echo e($category->name); ?>

                                    </label>
                                </div>
                                <span class="text-xs font-bold text-[#8c9082]"><?php echo e($category->product_count); ?></span>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="ms-4 flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                    <div class="flex items-center">
                                        <input wire:model='selectCategory' value="<?php echo e($child->id); ?>" type="checkbox"
                                            class="shrink-0 border-[#c9ccbd] bg-white text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42] checked:border-[#555a42]"
                                            id="category-<?php echo e($child->id); ?>">
                                        <label for="category-<?php echo e($child->id); ?>" class="ms-3 text-sm font-bold text-[#777c62]">
                                            &nbsp;└ <?php echo e($child->name); ?>

                                        </label>
                                    </div>
                                    <span class="text-xs font-bold text-[#8c9082]"><?php echo e($child->product_count); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="mt-7">
                    <span class="block text-sm font-black uppercase text-[#20221b]">Collections</span>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectCollection.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="mt-3 text-xs font-semibold text-red-600"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="mt-4 space-y-3">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between rounded-2xl bg-[#f7f7f2] px-3 py-3">
                                <div class="flex items-center">
                                    <input wire:model='selectCollection' value="<?php echo e($item->id); ?>" type="checkbox"
                                        class="shrink-0 border-[#c9ccbd] bg-white text-[#555a42] focus:ring-[#555a42] checked:bg-[#555a42] checked:border-[#555a42]"
                                        id="hs-default-checkbox-<?php echo e($i); ?>">
                                    <label for="hs-default-checkbox-<?php echo e($i); ?>" class="ms-3 text-sm font-bold text-[#555a42]">
                                        <?php echo e($item->name); ?>

                                    </label>
                                </div>
                                <span class="text-xs font-bold text-[#8c9082]"><?php echo e($item->product_count); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="mt-7 grid grid-cols-2 gap-3">
                    <button wire:click='applySearch' wire:loading.attr='disabled' type="button"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-full bg-[#555a42] px-4 text-sm font-black text-white transition hover:bg-[#3f4331] disabled:pointer-events-none disabled:opacity-50">
                        Apply
                        <div wire:loading class="inline-block size-4 animate-spin rounded-full border-2 border-current border-t-transparent text-white" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    <button wire:click='resetFilter' type="button"
                        class="inline-flex h-11 items-center justify-center rounded-full bg-[#f2f3ed] px-4 text-sm font-black text-[#555a42] transition hover:bg-[#e6e8de]">
                        Reset
                    </button>
                </div>
            </aside>

            <section>
                <div class="mb-5 flex flex-col gap-3 rounded-[1.5rem] bg-white p-3 shadow-sm ring-1 ring-black/5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex gap-2 overflow-x-auto scrollbar-hide">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [
                            ['label' => 'Newest', 'sort' => 'newest'],
                            ['label' => 'Popular', 'sort' => 'popular'],
                            ['label' => 'Sale', 'sort' => 'price_asc'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" wire:click="applySort('<?php echo e($chip['sort']); ?>')"
                                class="inline-flex h-10 shrink-0 items-center rounded-full px-4 text-xs font-black transition <?php echo e($shortBy === $chip['sort'] ? 'bg-[#555a42] text-white' : 'bg-[#f2f3ed] text-[#555a42] hover:bg-[#e6e8de]'); ?>">
                                <?php echo e($chip['label']); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-black uppercase tracking-[0.12em] text-[#777c62]">Sort</span>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['shortBy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-xs font-semibold text-red-600"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <select wire:model='shortBy'
                            class="h-10 rounded-full border-0 bg-[#f2f3ed] px-4 pe-9 text-sm font-bold text-[#555a42] focus:ring-2 focus:ring-[#777c62]/30 disabled:pointer-events-none disabled:opacity-50">
                            <option value="newest">Product Newest</option>
                            <option value="latest">Product Latest</option>
                            <option value="popular">Product Popular</option>
                            <option value="price_asc">Product Price A-Z</option>
                            <option value="price_desc">Product Price Z-A</option>
                        </select>
                    </div>
                </div>

<div wire:loading.remove class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if (isset($component)) { $__componentOriginale405491d357fabfcd42600c89d1c98f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale405491d357fabfcd42600c89d1c98f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.single-product-card','data' => ['product' => $product]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('single-product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale405491d357fabfcd42600c89d1c98f5)): ?>
<?php $attributes = $__attributesOriginale405491d357fabfcd42600c89d1c98f5; ?>
<?php unset($__attributesOriginale405491d357fabfcd42600c89d1c98f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale405491d357fabfcd42600c89d1c98f5)): ?>
<?php $component = $__componentOriginale405491d357fabfcd42600c89d1c98f5; ?>
<?php unset($__componentOriginale405491d357fabfcd42600c89d1c98f5); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full rounded-[1.5rem] bg-white py-14 text-center shadow-sm ring-1 ring-black/5">
                            <p class="font-display text-2xl font-black uppercase text-[#20221b]">Product not found</p>
                            <p class="mt-2 text-sm text-[#777b6d]">Coba kata kunci atau filter koleksi lain.</p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div wire:loading aria-hidden="true">
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

                <!--[if BLOCK]><![endif]--><?php if($products): ?>
                    <div class="mt-8">
                        <?php echo e($products->links()); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </section>
        </div>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/product-catalog.blade.php ENDPATH**/ ?>