<div x-data="{ isOpen: false }"
    @keydown.window.cmd.k.prevent="isOpen = true"
    @keydown.window.ctrl.k.prevent="isOpen = true"
    @keydown.window.escape="isOpen = false">

    <!-- SEARCH TRIGGER BUTTON (In Navbar) -->
    <button @click="isOpen = true" type="button"
        class="flex size-10 items-center justify-center rounded-full bg-[#f2f3ed] text-[#555a42] transition-all duration-300 hover:bg-[#e6e8de] hover:text-[#20221b] shadow-xs"
        aria-label="Cari produk" title="Live Search (Ctrl + K)">
        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.34-4.34" />
        </svg>
    </button>

    <!-- LIVE SEARCH MODAL OVERLAY -->
    <template x-teleport="body">
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 flex items-start justify-center pt-16 sm:pt-24 px-4 bg-black/60 backdrop-blur-md"
            style="z-index: 99999; display: none;">

            <!-- Click Outside to Close -->
            <div class="fixed inset-0" @click="isOpen = false"></div>

            <!-- MODAL CONTENT BOX -->
            <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
                class="relative w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-black/10 z-10">

                <!-- SEARCH INPUT HEADER -->
                <div class="relative flex items-center border-b border-gray-100 px-6 py-4">
                    <svg class="size-6 text-gray-400 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.34-4.34" />
                    </svg>

                    <input type="text"
                        wire:model.live.debounce.250ms="query"
                        x-init="$watch('isOpen', value => { if (value) setTimeout(() => $el.focus(), 50) })"
                        placeholder="Cari produk (misal: Hoodie, Shoes, Wireless)..."
                        class="w-full border-0 bg-transparent px-4 text-base font-semibold text-gray-900 placeholder-gray-400 focus:outline-hidden focus:ring-0">

                    <div class="flex items-center gap-2">
                        <!-- Loading Indicator -->
                        <div wire:loading class="size-4 animate-spin rounded-full border-2 border-zinc-900 border-t-transparent"></div>

                        <span class="hidden sm:inline-block rounded-md bg-gray-100 px-2 py-1 text-[10px] font-black uppercase text-gray-500">
                            ESC
                        </span>
                        <button @click="isOpen = false" type="button" class="text-gray-400 hover:text-gray-600 transition p-1">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- SEARCH RESULTS BODY -->
                <div class="max-h-[60vh] overflow-y-auto p-6 scrollbar-thin">
                        <!--[if BLOCK]><![endif]--><?php if(count($results) > 0): ?>
                            <div class="mb-3 flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                    <?php echo e(strlen(trim($query)) >= 2 ? __('Search results') : __('Product recommendations')); ?> (<?php echo e(count($results)); ?>)
                                </span>
                                <!--[if BLOCK]><![endif]--><?php if(strlen(trim($query)) >= 2): ?>
                                    <a href="<?php echo e(route('product-catalog', ['search' => $query])); ?>" class="text-xs font-bold text-indigo-600 hover:underline">
                                        <?php echo e(__('View All Catalog')); ?> &rarr;
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('product-catalog')); ?>" class="text-xs font-bold text-indigo-600 hover:underline">
                                        <?php echo e(__('View Catalog')); ?> &rarr;
                                    </a>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div class="grid grid-cols-1 gap-2.5">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('product', $item->slug)); ?>"
                                        @click="isOpen = false"
                                        class="group flex items-center gap-4 rounded-2xl border border-gray-100 p-3 transition hover:border-gray-300 hover:bg-gray-50/80 hover:shadow-md">
                                        <div class="relative size-16 shrink-0 overflow-hidden rounded-xl bg-gray-100">
                                            <img src="<?php echo e($item->cover_url); ?>" alt="<?php echo e($item->name); ?>" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <span class="inline-block rounded-full bg-gray-100 px-2 py-0.5 text-[10px] font-bold text-gray-600">
                                                    <?php echo e($item->short_desc ?: 'Catalog'); ?>

                                                </span>
                                            </div>
                                            <h4 class="mt-1 text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition truncate">
                                                <?php echo e($item->name); ?>

                                            </h4>
                                            <p class="text-xs font-black text-gray-900 mt-0.5">
                                                <?php echo e($item->price_formatted); ?>

                                            </p>
                                        </div>
                                        <div class="text-gray-400 group-hover:text-gray-900 transition">
                                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                                            </svg>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        <?php else: ?>
                            <!-- No Results State -->
                            <div class="py-10 text-center">
                                <div class="mx-auto flex size-12 items-center justify-center rounded-2xl bg-red-50 text-red-500 mb-3">
                                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-900"><?php echo e(__('Product :query was not found', ['query' => $query])); ?></h3>
                                <p class="mt-1 text-xs text-gray-400"><?php echo e(__('Try using a different search keyword.')); ?></p>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- MODAL FOOTER HINT -->
                <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50/60 px-6 py-3 text-[11px] text-gray-400">
                    <span><?php echo e(__('Press')); ?> <kbd class="rounded border bg-white px-1.5 py-0.5 text-gray-600 shadow-xs">ESC</kbd> <?php echo e(__('to close')); ?></span>
                    <span><?php echo e(__('Webstore instant search')); ?></span>
                </div>
            </div>
        </div>
    </template>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/global-search.blade.php ENDPATH**/ ?>