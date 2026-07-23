<div>
    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 gap-10 my-5 md:grid-cols-10">
            <div class="grid grid-cols-1 gap-10 pr-6 border-b md:border-b-0 md:border-r border-[#e2e8f0] md:col-span-3 pb-8 md:pb-0">
                <div>
                    <div class="space-y-3">
                        <input wire:model.live.debounce.250ms='search' type="text" placeholder="Search Your Product"
                            class="<?php $__errorArgs = ['search'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                border-red-600
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> py-2.5 sm:py-3 px-4 block w-full bg-white text-[#0f2d5a] border-[#e2e8f0] focus:border-[#1e40af] focus:ring-[#1e40af]/30 rounded-lg sm:text-sm placeholder-slate-400">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['search'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-xs"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <span class="block mt-6 mb-4 text-base font-bold text-[#0f2d5a]">
                        Collections
                    </span>
                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectCollection.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-red-600 text-xs mb-3">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    <div class="block space-y-3.5">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input wire:model='selectCollection' value="<?php echo e($item->id); ?>" type="checkbox"
                                        class="shrink-0 mt-0.5 bg-white border-[#cbd5e1] rounded-sm text-[#1e40af] focus:ring-[#1e40af] checked:bg-[#1e40af] checked:border-[#1e40af] disabled:opacity-50 disabled:pointer-events-none"
                                        id="hs-default-checkbox-<?php echo e($i); ?>">
                                    <label for="hs-default-checkbox-<?php echo e($i); ?>"
                                        class="text-sm font-medium text-[#4b6489] ms-3">
                                        <?php echo e($item->name); ?>

                                    </label>
                                </div>
                                <span class="text-sm text-[#4b6489]/70 font-light">(<?php echo e($item->product_count); ?>)</span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-8">
                        <button wire:click='applySeacrh' wire:loading.attr='disabled' type="button"
                            class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-white
                             bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg cursor-pointer gap-x-2 transition-colors duration-200 disabled:opacity-50 disabled:pointer-events-none">
                            Apply Filter
                            <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        <button wire:click='resetFilter' type="button"
                            class="inline-flex items-center justify-center text-sm font-semibold text-[#4b6489] hover:text-[#0f2d5a] rounded-lg cursor-pointer gap-x-2 border border-[#e2e8f0] hover:border-[#cbd5e1] transition-all duration-200">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-span-1 md:col-span-7">
                <div class="flex items-center justify-between gap-5">
                    <div class="font-medium text-[#4b6489]">Result: <span class="text-[#0f2d5a] font-bold"><?php echo e(($products) ? $products->total () : '0'); ?></span> items</div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-[#4b6489]">
                            Sort By:
                        </span>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['shortBy'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-red-600 text-xs">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                        <select
                            wire:model='shortBy'
                            class="px-3 py-2 text-[#0f2d5a] text-sm bg-white border-[#e2e8f0] focus:border-[#1e40af] focus:ring-[#1e40af]/30 rounded-lg pe-9 disabled:opacity-50 disabled:pointer-events-none">
                            <option selected="">Sort by latest</option>
                            <option value="newest">Product Newest</option>
                            <option value="latest">Product Latest</option>
                            <option value="price_asc">Product Price A-Z</option>
                            <option value="price_desc">Product Price Z-A</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 my-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
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
                        <div class="font-bold text-2xl text-[#0f2d5a] col-span-full py-10 text-center">
                            Product Not found
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                <!--[if BLOCK]><![endif]--><?php if($products): ?>
                    <div class="mt-8">
                    <?php echo e($products->links()); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/product-catalog.blade.php ENDPATH**/ ?>