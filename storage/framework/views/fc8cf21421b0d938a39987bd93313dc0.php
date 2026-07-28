    <div class="gap-2 mt-5">
      <div class="flex items-center">
            <div x-data="{ quantity: <?php if ((object) ('quantity') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('quantity'->value()); ?>')<?php echo e('quantity'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('quantity'); ?>')<?php endif; ?> }" class="flex gap-2 items-center my-5 w-full">
                <div class="inline-block px-3 py-2 bg-white border border-[#e2e8f0] rounded-lg">
                    <div class="flex items-center gap-x-1.5">
                        <button
                            class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-[#e2e8f0] rounded-md cursor-pointer size-6 gap-x-2 shadow-2xs hover:bg-[#f8fafc] focus:outline-hidden focus:bg-[#f8fafc] disabled:opacity-50 disabled:pointer-events-none"
                            @click="if(quantity > 0) quantity--">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <!-- Input jumlah -->
                        <input
                            class="p-0 w-6 bg-transparent border-0 text-[#0f2d5a] font-semibold text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                            style="-moz-appearance: textfield;" type="number" x-model.number="quantity"
                            @input="if(quantity < 0) quantity = 0" min="0">

                        <!-- Tombol tambah -->
                        <button type="button"
                            class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-[#e2e8f0] rounded-md cursor-pointer size-6 gap-x-2 shadow-2xs hover:bg-[#f8fafc] focus:outline-hidden focus:bg-[#f8fafc] disabled:opacity-50 disabled:pointer-events-none"
                            @click="quantity++">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <button wire:click='addCard' type="button"
                    class="inline-flex items-center justify-center w-full px-5 py-3 text-sm font-bold text-white bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg cursor-pointer gap-x-2 transition-colors duration-250 disabled:opacity-50 disabled:pointer-events-none">
                    <?php echo e($label); ?>

                     <div wire:loading  class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                      </div>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m5 11 4-7"></path>
                        <path d="m19 11-4-7"></path>
                        <path d="M2 11h20"></path>
                        <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8c.9 0 1.8-.7 2-1.6l1.7-7.4"></path>
                        <path d="m9 11 1 9"></path>
                        <path d="M4.5 15.5h15"></path>
                        <path d="m15 11-1 9"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="font-bold text-xs uppercase tracking-wider mt-2.5 text-[#1e40af]">Stock: <?php echo e($stock); ?> Left</div>
        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-red-600 text-xs my-3 uppercase font-semibold">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
    </div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/add-to-card.blade.php ENDPATH**/ ?>