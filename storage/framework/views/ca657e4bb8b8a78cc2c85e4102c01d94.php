<div>
    <style>
        .checkout-page { background: #f7f2e8; padding: 2rem clamp(1rem, 3vw, 2.5rem) 4rem; }
        .checkout-shell { max-width: 92rem; margin: 0 auto; }
        .checkout-header { margin-bottom: 1.5rem; }
        .checkout-kicker { color: #8b7659; font-size: .75rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        .checkout-title { margin-top: .45rem; color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: clamp(2.6rem, 6vw, 5.5rem); font-weight: 900; line-height: .86; text-transform: uppercase; }
        .checkout-grid { display: grid; gap: 1.5rem; align-items: start; }
        .checkout-card { border: 1px solid #d7c7ad; background: #fffaf2; border-radius: 1.5rem; box-shadow: 0 18px 45px rgba(79,68,48,.08); overflow: hidden; }
        .checkout-section { padding: 1.25rem; border-bottom: 1px solid #d7c7ad; }
        .checkout-section:last-child { border-bottom: 0; }
        .checkout-section h2, .checkout-summary-title { color: #211b14; font-family: Finlandica, Inter, sans-serif; font-size: 1.65rem; font-weight: 900; text-transform: uppercase; }
        .checkout-field-grid { display: grid; gap: 1rem; margin-top: 1rem; }
        .checkout-field label { display: block; margin-bottom: .45rem; color: #77664c; font-size: .72rem; font-weight: 900; letter-spacing: .12em; text-transform: uppercase; }
        .checkout-input { width: 100%; min-height: 3rem; border: 1px solid #d7c7ad; border-radius: 1rem; background: #f9f1e4; color: #211b14; padding: .75rem 1rem; outline: none; }
        .checkout-input:focus { border-color: #8b7659; box-shadow: 0 0 0 3px rgba(139,118,89,.14); }
        .checkout-error { margin-top: .5rem; color: #b42318; font-size: .75rem; font-weight: 800; }
        .checkout-choice { display: flex; align-items: center; justify-content: space-between; gap: 1rem; width: 100%; padding: 1rem; border: 1px solid #d7c7ad; border-radius: 1.1rem; background: #f9f1e4; cursor: pointer; transition: .2s ease; }
        .checkout-choice:hover { background: #f3eadc; border-color: #bda987; }
        .checkout-choice input { accent-color: #4d4634; }
        .checkout-choice-title { color: #211b14; font-size: .95rem; font-weight: 900; }
        .checkout-choice-price { color: #4d4634; font-size: .9rem; font-weight: 900; white-space: nowrap; }
        .checkout-list { display: grid; gap: .75rem; margin-top: 1rem; }
        .checkout-muted-box { margin-top: .75rem; padding: .85rem 1rem; border: 1px solid #d7c7ad; border-radius: 1rem; background: #f3eadc; color: #5d523f; font-size: .9rem; }
        .checkout-dropdown { position: absolute; z-index: 30; width: 100%; margin-top: .35rem; max-height: 15rem; overflow: auto; border: 1px solid #d7c7ad; border-radius: 1rem; background: #fffaf2; box-shadow: 0 18px 38px rgba(79,68,48,.12); }
        .checkout-dropdown li { padding: .8rem 1rem; color: #211b14; font-size: .9rem; cursor: pointer; }
        .checkout-dropdown li:hover { background: #f3eadc; }
        .checkout-summary { padding: 1.25rem; position: sticky; top: 6rem; }
        .summary-products { margin-top: 1rem; display: grid; gap: .75rem; }
        .summary-box { margin-top: 1rem; border: 1px solid #d7c7ad; border-radius: 1.1rem; overflow: hidden; background: #f8f0e2; }
        .summary-row { display: flex; justify-content: space-between; gap: 1rem; padding: 1rem; color: #5d523f; font-size: .95rem; border-bottom: 1px solid #d7c7ad; }
        .summary-row:last-child { border-bottom: 0; background: #fffaf2; color: #211b14; font-weight: 900; }
        .summary-row strong { color: #4d4634; }
        .place-order-btn { margin-top: 1rem; width: 100%; height: 3.35rem; border: 0; border-radius: 999px; background: #4d4634; color: #fffaf2; font-size: .9rem; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 0 14px 26px rgba(77,70,52,.16); transition: .2s ease; }
        .place-order-btn:hover { transform: translateY(-2px); background: #2f2a20; }
        @media (min-width: 760px) { .checkout-field-grid.two { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 980px) { .checkout-grid { grid-template-columns: minmax(0, 1fr) 28rem; } }
    </style>

    <div class="checkout-page">
        <div class="checkout-shell">
            <div class="checkout-header">
                <p class="checkout-kicker">Secure checkout</p>
                <h1 class="checkout-title">Complete your order.</h1>
            </div>

            <div class="checkout-grid">
                <section class="checkout-card">
                    <div class="checkout-section">
                        <h2>Billing contact</h2>
                        <div class="checkout-field-grid two">
                            <div class="checkout-field" style="grid-column: 1 / -1;">
                                <label>Full name</label>
                                <input wire:model='data.full_name' type="text" class="checkout-input <?php $__errorArgs = ['data.full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Full Name">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="checkout-field">
                                <label>Email address</label>
                                <input type="text" wire:model='data.email' class="checkout-input <?php $__errorArgs = ['data.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Email">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="checkout-field">
                                <label>Phone number</label>
                                <input type="text" wire:model='data.phone' class="checkout-input <?php $__errorArgs = ['data.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Phone Number">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Billing address</h2>
                        <div class="checkout-field-grid">
                            <div class="checkout-field">
                                <label>Street address</label>
                                <input wire:model='data.address_line' type="text" class="checkout-input <?php $__errorArgs = ['data.address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Street Address">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div class="checkout-field">
                                <label>Cari lokasi / kota / kecamatan</label>
                                <?php
                                    $regionList = [];
                                    try {
                                        if ($this->regions) {
                                            foreach ($this->regions as $r) { $regionList[] = $r; }
                                        }
                                    } catch (\Throwable $e) { $regionList = []; }

                                    try { $selectedRegion = $this->region; } catch (\Throwable $e) { $selectedRegion = null; }
                                ?>
                                <div x-data="{ open: false }" class="relative w-full">
                                    <input type="text" wire:model.live.debounce.500ms='region_selector.keyword' x-on:focus="open = true" x-on:click.outside="open = false" class="checkout-input" placeholder="Ketik nama kota atau kecamatan...">
                                    <div wire:loading wire:target='region_selector.keyword' class="absolute right-4 top-4 animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#4d4634] rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>

                                    <!--[if BLOCK]><![endif]--><?php if(count($regionList) > 0): ?>
                                        <ul class="checkout-dropdown" x-show="open" x-cloak>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $regionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $rCode = data_get($region, 'code'); $rLabel = data_get($region, 'label'); ?>
                                                <li wire:key="region-<?php echo e($rCode); ?>">
                                                    <label for="region-<?php echo e($rCode); ?>" class="w-full inline-block cursor-pointer">
                                                        <input type="radio" value="<?php echo e($rCode); ?>" wire:model.live='region_selector.region_selected' class="sr-only" id="region-<?php echo e($rCode); ?>">
                                                        <?php echo e($rLabel); ?>

                                                    </label>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                    <!--[if BLOCK]><![endif]--><?php if($selectedRegion): ?>
                                        <div class="checkout-muted-box">Lokasi dipilih: <strong><?php echo e(data_get($selectedRegion, 'label')); ?></strong></div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.destination_region_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Shipping method</h2>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.shipping_hash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="w-full relative flex justify-center">
                            <div wire:loading wire:target='region_selector.region_selected' class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-[#4d4634] rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>
                        </div>
                        <div class="checkout-list">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $this->shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_name => $shipping_method_groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <p class="checkout-kicker"><?php echo e($group_name); ?></p>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $shipping_method_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $shipping_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label for="shipping_method_<?php echo e($shipping_method->hash); ?>" class="checkout-choice">
                                        <span class="flex items-center gap-3">
                                            <input wire:key='<?php echo e($shipping_method->hash); ?>' wire:model.live='data.shipping_hash' type="radio" value="<?php echo e($shipping_method->hash); ?>" id="shipping_method_<?php echo e($shipping_method->hash); ?>">
                                            <!--[if BLOCK]><![endif]--><?php if($shipping_method->logo_url): ?><img src="<?php echo e($shipping_method->logo_url); ?>" class="h-5" alt="<?php echo e($shipping_method->label); ?>" /><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <span class="checkout-choice-title"><?php echo e($shipping_method->label); ?></span>
                                        </span>
                                        <span class="checkout-choice-price"><?php echo e($shipping_method->cost_formatted); ?></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="checkout-muted-box text-red-700">Please fill in the Shipping Address above first.</div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <div class="checkout-section">
                        <h2>Payment method</h2>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.payment_method_hash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="checkout-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="checkout-list">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->payment_methods->toCollection(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="payment_method_<?php echo e($payment_method->hash); ?>" class="checkout-choice">
                                    <span class="flex items-center gap-3">
                                        <input type="radio" wire:key='payment_method-<?php echo e($payment_method->hash); ?>' wire:model='payment_method_selector.payment_method_selected' value="<?php echo e($payment_method->hash); ?>" id="payment_method_<?php echo e($payment_method->hash); ?>">
                                        <span class="checkout-choice-title"><?php echo e($payment_method->label); ?></span>
                                    </span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                </section>

                <aside class="checkout-card checkout-summary">
                    <h2 class="checkout-summary-title">Order summary</h2>
                    <div class="summary-products">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal43c24292102d4519d5016657455adb19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43c24292102d4519d5016657455adb19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.single-product-list','data' => ['cartItem' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('single-product-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cart_item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43c24292102d4519d5016657455adb19)): ?>
<?php $attributes = $__attributesOriginal43c24292102d4519d5016657455adb19; ?>
<?php unset($__attributesOriginal43c24292102d4519d5016657455adb19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43c24292102d4519d5016657455adb19)): ?>
<?php $component = $__componentOriginal43c24292102d4519d5016657455adb19; ?>
<?php unset($__componentOriginal43c24292102d4519d5016657455adb19); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="summary-box">
                        <div class="summary-row"><span>Sub total</span><strong><?php echo e(data_get($this->summary, 'sub_total_formatted')); ?></strong></div>
                        <div class="summary-row"><span><?php echo e($this->shippingMethod->label ?? "Shipping"); ?><br><small><?php echo e($this->shippingMethod?->weight ?? 0); ?> grams</small></span><strong><?php echo e(data_get($this->summary, 'shipping_total_formatted')); ?></strong></div>
                        <div class="summary-row"><span>Total amount</span><strong><?php echo e(data_get($this->summary, 'grand_total_formatted')); ?></strong></div>
                    </div>
                    <button type="button" wire:click='placeAnOrder()' wire:loading.attr='disabled' class="place-order-btn">
                        Place an order
                        <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading"><span class="sr-only">Loading...</span></div>
                    </button>
                </aside>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/checkout.blade.php ENDPATH**/ ?>