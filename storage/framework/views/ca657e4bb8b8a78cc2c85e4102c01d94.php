<div>
    <style>
        .linoge-checkout {
            background-color: #eaeae8;
            color: #111111;
            padding: 2.5rem clamp(1rem, 4vw, 3.5rem) 5rem;
        }

        .linoge-shell {
            max-width: 92rem;
            margin: 0 auto;
        }

        .linoge-header {
            margin-bottom: 2.5rem;
        }

        .linoge-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-weight: 900;
            font-size: clamp(3rem, 8vw, 6rem);
            line-height: 0.88;
            letter-spacing: -0.03em;
            text-transform: uppercase;
            color: #111111;
        }

        .linoge-grid {
            display: grid;
            gap: 2.5rem;
            align-items: start;
        }

        .linoge-section {
            margin-bottom: 2.5rem;
        }

        .linoge-section-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #111111;
            letter-spacing: -0.01em;
            margin-bottom: 1.25rem;
        }

        .linoge-sub-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #444444;
            margin-bottom: 0.85rem;
        }

        .linoge-field-grid {
            display: grid;
            gap: 1rem;
        }

        .linoge-field-grid.two {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        @media (min-width: 640px) {
            .linoge-field-grid.two {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .linoge-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            color: #666666;
            margin-bottom: 0.35rem;
        }

        .linoge-input {
            width: 100%;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            border-radius: 0px;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #111111;
            transition: all 0.2s ease;
        }

        .linoge-input:focus {
            background-color: #ffffff;
            border-color: #111111;
            outline: none;
            box-shadow: 0 0 0 1px #111111;
        }

        .linoge-choice {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            width: 100%;
            padding: 1rem 1.2rem;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .linoge-choice:hover {
            border-color: #111111;
            background-color: #ffffff;
        }

        .linoge-choice input[type="radio"] {
            accent-color: #111111;
            width: 1rem;
            height: 1rem;
        }

        .linoge-choice-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: #111111;
        }

        .linoge-choice-price {
            font-size: 0.85rem;
            font-weight: 700;
            color: #111111;
            white-space: nowrap;
        }

        .linoge-error {
            margin-top: 0.35rem;
            color: #dc2626;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .linoge-dropdown {
            position: absolute;
            z-index: 30;
            width: 100%;
            margin-top: 0.25rem;
            max-height: 14rem;
            overflow-y: auto;
            border: 1px solid #111111;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .linoge-dropdown li {
            padding: 0.75rem 1rem;
            color: #111111;
            font-size: 0.85rem;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }

        .linoge-dropdown li:hover {
            background: #f4f4f2;
            font-weight: 600;
        }

        .linoge-summary {
            background-color: #eaeae8;
            position: sticky;
            top: 6rem;
        }

        .linoge-summary-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 1.5rem;
        }

        .linoge-summary-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #111111;
            letter-spacing: -0.01em;
        }

        .linoge-summary-count {
            font-size: 0.85rem;
            font-weight: 700;
            color: #666666;
        }

        .linoge-promocode-row {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .linoge-promocode-input {
            flex-grow: 1;
            background-color: #f4f4f2;
            border: 1px solid #d4d4d0;
            padding: 0.65rem 0.85rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .linoge-promocode-btn {
            background-color: #d8d8d4;
            color: #555555;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.65rem 1.25rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .linoge-promocode-btn:hover {
            background-color: #111111;
            color: #ffffff;
        }

        .linoge-breakdown {
            border-top: 1px solid #d4d4d0;
            padding-top: 1.25rem;
            margin-top: 1rem;
            display: grid;
            gap: 0.75rem;
        }

        .linoge-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #555555;
        }

        .linoge-row strong {
            color: #111111;
            font-weight: 700;
        }

        .linoge-row.total {
            border-top: 1px solid #111111;
            padding-top: 1rem;
            margin-top: 0.5rem;
            font-size: 1.1rem;
            font-weight: 900;
            color: #111111;
        }

        .linoge-row.total strong {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
        }

        .linoge-btn-primary {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1.15rem;
            background-color: #111111;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .linoge-btn-primary:hover {
            background-color: #000000;
            opacity: 0.95;
        }

        @media (min-width: 980px) {
            .linoge-grid {
                grid-template-columns: minmax(0, 1fr) 28rem;
            }
        }
    </style>

    <div class="linoge-checkout">
        <div class="linoge-shell">
            <!-- PAGE HEADER -->
            <div class="linoge-header">
                <h1 class="linoge-title">CHECKOUT</h1>
            </div>

            <div class="linoge-grid">
                <!-- MAIN FORM COLUMN -->
                <div class="linoge-main">
                    <!-- SECTION 1: INFORMATION -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Information</h2>

                        <!-- Personal Information -->
                        <div class="mb-6">
                            <div class="flex justify-between items-baseline mb-3">
                                <h3 class="linoge-sub-title">Personal Information</h3>
                                <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->guest()): ?>
                                    <span class="text-xs text-neutral-500">Already have an account? <a
                                            href="<?php echo e(route('login')); ?>" class="underline text-neutral-900 font-semibold">Log
                                            in</a></span>
                                <?php else: ?>
                                    <span class="text-xs text-neutral-500">Signed in as <strong
                                            class="text-neutral-900"><?php echo e(auth()->user()->name); ?></strong></span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="linoge-field-grid two">
                                <div>
                                    <label class="linoge-label">Full name</label>
                                    <input wire:model='data.full_name' type="text"
                                        class="linoge-input <?php $__errorArgs = ['data.full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Full name">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="linoge-error"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div>
                                    <label class="linoge-label">Email address</label>
                                    <input type="text" wire:model='data.email'
                                        class="linoge-input <?php $__errorArgs = ['data.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Email address">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="linoge-error"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="linoge-label">Phone number</label>
                                    <input type="text" wire:model='data.phone'
                                        class="linoge-input <?php $__errorArgs = ['data.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Phone number">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="linoge-error"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        <div>
                            <h3 class="linoge-sub-title">Shipping Information</h3>

                            <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
                                <!--[if BLOCK]><![endif]--><?php if($this->saved_addresses->isNotEmpty()): ?>
                                    <div class="mb-4">
                                        <label class="linoge-label">Use saved address</label>
                                        <div class="linoge-promocode-row" style="margin-top:0;">
                                            <select wire:model='address_selector.address_id' class="linoge-input"
                                                style="flex-grow:1;">
                                                <option value="">— Pilih alamat tersimpan —</option>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->saved_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saved): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($saved->id); ?>"><?php echo e($saved->label); ?> &middot;
                                                        <?php echo e($saved->address_line); ?>, <?php echo e($saved->city); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </select>
                                            <button type="button" wire:click='applyAddress'
                                                class="linoge-promocode-btn">APPLY</button>
                                        </div>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <p class="mb-3 text-xs text-neutral-500">
                                    <a href="<?php echo e(route('account.addresses')); ?>"
                                        class="underline text-neutral-900 font-semibold">Kelola alamat</a>
                                </p>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <div class="linoge-field-grid">
                                <div>
                                    <label class="linoge-label">Street address</label>
                                    <input wire:model='data.address_line' type="text"
                                        class="linoge-input <?php $__errorArgs = ['data.address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Address">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="linoge-error"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div>
                                    <label class="linoge-label">City / Region / Location search</label>
                                    <?php
                                        $regionList = [];
                                        try {
                                            if ($this->regions) {
                                                foreach ($this->regions as $r) {
                                                    $regionList[] = $r;
                                                }
                                            }
                                        } catch (\Throwable $e) {
                                            $regionList = [];
                                        }

                                        try {
                                            $selectedRegion = $this->region;
                                        } catch (\Throwable $e) {
                                            $selectedRegion = null;
                                        }
                                    ?>
                                    <div x-data="{ open: false }" class="relative w-full">
                                        <input type="text" wire:model.live.debounce.500ms='region_selector.keyword'
                                            x-on:focus="open = true" x-on:click.outside="open = false"
                                            class="linoge-input" placeholder="Type city or kecamatan name...">
                                        <div wire:loading wire:target='region_selector.keyword'
                                            class="absolute right-4 top-3.5 animate-spin inline-block size-4 border-2 border-current border-t-transparent text-neutral-900 rounded-full"
                                            role="status" aria-label="loading"></div>

                                        <!--[if BLOCK]><![endif]--><?php if(count($regionList) > 0): ?>
                                            <ul class="linoge-dropdown" x-show="open" x-cloak>
                                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $regionList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $rCode = data_get($region, 'code');
                                                        $rLabel = data_get($region, 'label');
                                                    ?>
                                                    <li wire:key="region-<?php echo e($rCode); ?>">
                                                        <label for="region-<?php echo e($rCode); ?>"
                                                            class="w-full inline-block cursor-pointer">
                                                            <input type="radio" value="<?php echo e($rCode); ?>"
                                                                wire:model.live='region_selector.region_selected'
                                                                class="sr-only" id="region-<?php echo e($rCode); ?>">
                                                            <?php echo e($rLabel); ?>

                                                        </label>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                            </ul>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                        <!--[if BLOCK]><![endif]--><?php if($selectedRegion): ?>
                                            <div
                                                class="mt-2 p-2.5 bg-neutral-200/60 border border-neutral-300 text-xs text-neutral-800 font-medium">
                                                Selected location:
                                                <strong><?php echo e(data_get($selectedRegion, 'label')); ?></strong>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.destination_region_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="linoge-error"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- SECTION 2: DELIVERY -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Delivery</h2>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.shipping_hash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="linoge-error mb-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="w-full relative flex justify-center my-1">
                            <div wire:loading wire:target='region_selector.region_selected'
                                class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-neutral-900 rounded-full"
                                role="status" aria-label="loading"></div>
                        </div>
                        <div wire:loading.remove wire:target='region_selector.region_selected' class="space-y-2">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $this->shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_name => $shipping_method_groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <p class="text-xs font-bold uppercase tracking-wider text-neutral-500 mt-3 mb-1">
                                    <?php echo e($group_name); ?></p>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $shipping_method_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $shipping_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label for="shipping_method_<?php echo e($shipping_method->hash); ?>" class="linoge-choice">
                                        <span class="flex items-center gap-3">
                                            <input wire:key='<?php echo e($shipping_method->hash); ?>'
                                                wire:model.live='data.shipping_hash' type="radio"
                                                value="<?php echo e($shipping_method->hash); ?>"
                                                id="shipping_method_<?php echo e($shipping_method->hash); ?>">
                                            <!--[if BLOCK]><![endif]--><?php if($shipping_method->logo_url): ?>
                                                <img src="<?php echo e($shipping_method->logo_url); ?>"
                                                    class="h-4 object-contain" alt="<?php echo e($shipping_method->label); ?>" />
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <span class="linoge-choice-title"><?php echo e($shipping_method->label); ?></span>
                                        </span>
                                        <span
                                            class="linoge-choice-price"><?php echo e($shipping_method->cost_formatted); ?></span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div
                                    class="p-3 bg-neutral-200/60 border border-neutral-300 text-xs text-neutral-600 font-medium">
                                    Please enter your Shipping Address above first.
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <div wire:loading wire:target='region_selector.region_selected' class="space-y-2" aria-hidden="true">
                            <!--[if BLOCK]><![endif]--><?php for($i = 0; $i < 3; $i++): ?>
                                <div class="animate-pulse flex items-center justify-between gap-4 w-full p-3 bg-[#f4f4f2] border border-[#d4d4d0]">
                                    <div class="h-4 w-44 rounded-full bg-neutral-200/80"></div>
                                    <div class="h-4 w-20 rounded-full bg-neutral-200/80"></div>
                                </div>
                            <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </section>

                    <!-- SECTION 3: PAYMENT -->
                    <section class="linoge-section">
                        <h2 class="linoge-section-title">Payment</h2>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['data.payment_method_hash'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="linoge-error mb-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="space-y-2">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->payment_methods->toCollection(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label for="payment_method_<?php echo e($payment_method->hash); ?>" class="linoge-choice">
                                    <span class="flex items-center gap-3">
                                        <input type="radio" wire:key='payment_method-<?php echo e($payment_method->hash); ?>'
                                            wire:model='payment_method_selector.payment_method_selected'
                                            value="<?php echo e($payment_method->hash); ?>"
                                            id="payment_method_<?php echo e($payment_method->hash); ?>">
                                        <span class="linoge-choice-title"><?php echo e($payment_method->label); ?></span>
                                    </span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </section>
                </div>

                <!-- SIDEBAR: SHOPPING BAG SUMMARY -->
                <aside class="linoge-summary">
                    <div class="linoge-summary-header">
                        <h2 class="linoge-summary-title">Shopping Bag</h2>
                        <span
                            class="linoge-summary-count">(<?php echo e($cart->items->toCollection()->sum('quantity')); ?>)</span>
                    </div>

                    <!-- Item list -->
                    <div class="divide-y divide-neutral-300">
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

                    <!-- Promocode input -->
                    <!--[if BLOCK]><![endif]--><?php if(empty(data_get($this->summary, 'coupon_code'))): ?>
                        <div class="linoge-promocode-row">
                            <input type="text" wire:model='coupon_input' wire:keydown.enter.prevent='applyCoupon'
                                placeholder="KODE PROMO / VOUCHER" class="linoge-promocode-input uppercase">
                            <button type="button" wire:click='applyCoupon' wire:loading.attr='disabled'
                                class="linoge-promocode-btn">APPLY</button>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['coupon_input'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="linoge-error mb-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                        <div class="my-4 p-3 bg-neutral-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">KUPON
                                    AKTIF:</span>
                                <span
                                    class="text-xs font-mono font-bold"><?php echo e(data_get($this->summary, 'coupon_code')); ?></span>
                            </div>
                            <button type="button" wire:click='removeCoupon'
                                class="text-xs text-red-400 hover:text-red-300 font-bold underline">HAPUS</button>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!-- Breakdown -->
                    <div wire:loading.remove wire:target='data.shipping_hash, applyCoupon, removeCoupon' class="linoge-breakdown">
                        <div class="linoge-row">
                            <span>Sub total</span>
                            <strong><?php echo e(data_get($this->summary, 'sub_total_formatted')); ?></strong>
                        </div>
                        <div class="linoge-row">
                            <span>Shipping</span>
                            <strong><?php echo e(data_get($this->summary, 'shipping_total_formatted', 'Free')); ?></strong>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php if(data_get($this->summary, 'discount_total', 0) > 0): ?>
                            <div class="linoge-row text-emerald-700">
                                <span>Diskon Kupon</span>
                                <strong class="text-emerald-700">-
                                    <?php echo e(data_get($this->summary, 'discount_total_formatted')); ?></strong>
                            </div>
                        <?php else: ?>
                            <div class="linoge-row">
                                <span>Diskon</span>
                                <strong>Rp 0</strong>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="linoge-row total">
                            <span>Total:</span>
                            <strong><?php echo e(data_get($this->summary, 'grand_total_formatted')); ?></strong>
                        </div>
                    </div>

                    <div wire:loading wire:target='data.shipping_hash, applyCoupon, removeCoupon'
                        class="linoge-breakdown" aria-hidden="true">
                        <?php if (isset($component)) { $__componentOriginal5efad19ddc2c780f63372f0b9587556f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5efad19ddc2c780f63372f0b9587556f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.skeleton.checkout-summary','data' => ['rows' => 4]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('skeleton.checkout-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rows' => 4]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5efad19ddc2c780f63372f0b9587556f)): ?>
<?php $attributes = $__attributesOriginal5efad19ddc2c780f63372f0b9587556f; ?>
<?php unset($__attributesOriginal5efad19ddc2c780f63372f0b9587556f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5efad19ddc2c780f63372f0b9587556f)): ?>
<?php $component = $__componentOriginal5efad19ddc2c780f63372f0b9587556f; ?>
<?php unset($__componentOriginal5efad19ddc2c780f63372f0b9587556f); ?>
<?php endif; ?>
                    </div>

                    <!-- Primary Action Button -->
                    <button type="button" wire:click='placeAnOrder()' wire:loading.attr='disabled'
                        class="linoge-btn-primary">
                        <span>PAY AND PLACE ORDER</span>
                        <div wire:loading
                            class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-white rounded-full"
                            role="status" aria-label="loading"></div>
                    </button>
                </aside>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/checkout.blade.php ENDPATH**/ ?>