<div>
    <?php if (isset($component)) { $__componentOriginalfa92fd5562a0c82e62f2e625d459a2d3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa92fd5562a0c82e62f2e625d459a2d3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.store-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('store-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php $__env->startPush('head'); ?>
            <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js" defer></script>
            <script type="text/javascript" defer>
                window.addEventListener("load", function() {
                    confetti({
                        particleCount: 60,
                        spread: 50,
                        origin: {
                            y: 0.6
                        }
                    });
                });
            </script>
            <style>
                @media print {

                    header,
                    footer,
                    .no-print {
                        display: none !important;
                    }

                    body {
                        background: white !important;
                        padding: 0 !important;
                    }

                    .print-container {
                        width: 100% !important;
                        max-width: 100% !important;
                        box-shadow: none !important;
                        border: none !important;
                    }
                }
            </style>
        <?php $__env->stopPush(); ?>

        <div class="container mx-auto max-w-2xl px-3 sm:px-5 py-6">
            <div class="print-container relative overflow-hidden rounded-2xl bg-white p-5 sm:p-6 shadow-md border border-[#e2e8f0]"
                data-aos="fade-up">

                
                <div
                    class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-[#f0f0eb] pb-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#20221b] text-white shadow-xs">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                <path d="m3.3 7 8.7 5 8.7-5" />
                                <path d="M12 12v9.5" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h1 class="font-display text-lg sm:text-xl font-black text-[#20221b] tracking-tight">
                                    Order <?php echo e($order->trx_id); ?>

                                </h1>
                                <?php
                                    $statusBg = match (true) {
                                        str_contains(strtolower($order->status_label ?? ''), 'selesai')
                                            => 'bg-[#555a42]/10 text-[#555a42] border-[#555a42]/20',
                                        str_contains(strtolower($order->status_label ?? ''), 'batal')
                                            => 'bg-rose-50 text-rose-700 border-rose-200',
                                        str_contains(strtolower($order->status_label ?? ''), 'proses')
                                            => 'bg-blue-50 text-blue-700 border-blue-200',
                                        default => 'bg-amber-50 text-amber-800 border-amber-200',
                                    };
                                ?>
                                <span
                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider <?php echo e($statusBg); ?>">
                                    <?php echo e($order->status_label); ?>

                                </span>
                            </div>
                            <p class="text-[11px] font-medium text-[#8c9082]">
                                Dibuat pada <?php echo e($order->created_at_formatted); ?>

                            </p>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-2 no-print">
                        <button onclick="window.print()" type="button"
                            class="inline-flex items-center gap-1.5 rounded-xl bg-[#f2f3ed] mb-5 px-3 py-2 text-xs font-bold text-[#555a42] hover:bg-[#e6e8de] transition">
                            <svg class="size-3.5 text-[#555a42]" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>
                            Cetak
                        </button>
                    </div>
                </div>

                
                <div class="mt-5">
                    <div class="flex items-center justify-between mb-2.5">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.14em] text-[#8c9082]">Order Tracking</h2>
                        <!--[if BLOCK]><![endif]--><?php if(!empty($order->shipping->estimated_delivery)): ?>
                            <span class="text-[9px] font-bold text-[#555a42] bg-[#f2f3ed] px-2 py-0.5 rounded-full">
                                Estimasi: <?php echo e($order->shipping->estimated_delivery); ?>

                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    
                    <div class="rounded-xl bg-[#f7f7f2] p-3 border border-[#e8e9e1]">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            <?php
                                $steps = [
                                    ['name' => 'Pesanan Dibuat', 'desc' => $order->created_at_formatted, 'active' => true],
                                    [
                                        'name' => 'Pembayaran',
                                        'desc' => 'Tempo: ' . $order->due_date_at_formatted,
                                        'active' => true,
                                    ],
                                    [
                                        'name' => 'Pengiriman',
                                        'desc' => $order->shipping->courier ?? 'Kurir Ekspres',
                                        'active' =>
                                            str_contains(strtolower($order->status_label ?? ''), 'proses') ||
                                            str_contains(strtolower($order->status_label ?? ''), 'selesai'),
                                    ],
                                    [
                                        'name' => 'Selesai',
                                        'desc' => 'Terkirim',
                                        'active' => str_contains(strtolower($order->status_label ?? ''), 'selesai'),
                                    ],
                                ];
                            ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex flex-col items-start gap-0.5 min-w-0">
                                    <div class="flex items-center gap-1.5 min-w-0 w-full">
                                        <span
                                            class="flex size-4.5 shrink-0 items-center justify-center rounded-full text-[9px] font-bold <?php echo e($st['active'] ? 'bg-[#555a42] text-white' : 'bg-[#e6e8de] text-[#8c9082]'); ?>">
                                            <!--[if BLOCK]><![endif]--><?php if($st['active']): ?>
                                                ✓
                                            <?php else: ?>
                                                <?php echo e($i + 1); ?>

                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </span>
                                        <span
                                            class="text-[10px] sm:text-[11px] font-bold truncate min-w-0 <?php echo e($st['active'] ? 'text-[#20221b]' : 'text-[#8c9082]'); ?>">
                                            <?php echo e($st['name']); ?>

                                        </span>
                                    </div>
                                    <p
                                        class="text-[9px] font-medium text-[#8c9082] leading-tight pl-6 truncate w-full">
                                        <?php echo e($st['desc']); ?>

                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                </div>

                
                <div
                    class="mt-3.5 grid grid-cols-2 md:grid-cols-4 gap-2.5 p-3 rounded-xl bg-[#f7f7f2] border border-[#e8e9e1]">
                    <div class="min-w-0">
                        <span class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">Tanggal</span>
                        <span
                            class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate"><?php echo e($order->created_at_formatted); ?></span>
                    </div>
                    <div class="min-w-0">
                        <span
                            class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">Pembayaran</span>
                        <span
                            class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate" title="<?php echo e($order->payment->label); ?>"><?php echo e($order->payment->label); ?></span>
                    </div>
                    <div class="min-w-0">
                        <span
                            class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">Ekspedisi</span>
                        <span class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate">
                            <?php echo e(strtoupper($order->shipping->courier ?? 'Reguler')); ?>

                            <!--[if BLOCK]><![endif]--><?php if(!empty($order->shipping->receipt_number)): ?>
                                <span class="block text-[8px] text-[#555a42] font-black">Resi:
                                    <?php echo e($order->shipping->receipt_number); ?></span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </span>
                    </div>
                    <div class="min-w-0">
                        <span class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">Alamat</span>
                        <span class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate"
                            title="<?php echo e($order->address_line); ?>">
                            <?php echo e($order->customer->full_name); ?> —
                            <?php echo e($order->destination->city ?? $order->address_line); ?>

                        </span>
                    </div>
                </div>

                
                <div class="mt-5">
                    <div class="flex items-center justify-between mb-2.5">
                        <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082]">Order Info</h2>
                        <span class="text-xs font-bold text-[#8c9082]">
                            <?php echo e($order->items->count()); ?> Produk
                        </span>
                    </div>

                    <div class="divide-y divide-[#f0f0eb] rounded-xl border border-[#e8e9e1] bg-white overflow-hidden">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-3 p-3 hover:bg-[#f7f7f2]/60 transition">
                                <div
                                    class="size-12 shrink-0 overflow-hidden rounded-lg bg-[#f2f3ed] border border-[#e2e8f0]">
                                    <img src="<?php echo e($item->cover_url); ?>" alt="<?php echo e($item->name); ?>"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-bold text-[#20221b] truncate"><?php echo e($item->name); ?></h3>
                                    <div class="mt-0.5 flex items-center gap-2">
                                        <span
                                            class="text-[11px] font-bold text-[#555a42]"><?php echo e($item->price_formatted); ?></span>
                                        <span
                                            class="inline-flex items-center rounded-md bg-[#f2f3ed] px-1.5 py-0.2 text-[10px] font-bold text-[#555a42]">
                                            Qty: <?php echo e($item->quantity); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-black text-[#20221b]"><?php echo e($item->total_formatted); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                
                <div class="mt-5">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082] mb-2.5">Order Summary
                    </h2>
                    <div class="rounded-xl bg-[#f7f7f2] p-4 border border-[#e8e9e1] space-y-2 text-xs">
                        <div class="flex items-center justify-between text-[#555a42] font-medium">
                            <span>Subtotal Produk</span>
                            <span class="font-bold text-[#20221b]"><?php echo e($order->sub_total_formatted); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-[#555a42] font-medium">
                            <span>Ongkos Kirim (Shipping)</span>
                            <span class="font-bold text-[#20221b]"><?php echo e($order->shipping_total_formatted); ?></span>
                        </div>
                        <div class="border-t border-[#e6e8de] pt-2 flex items-center justify-between">
                            <span class="text-xs font-black uppercase text-[#20221b]">Total Pembayaran</span>
                            <span class="text-base font-black text-[#20221b]"><?php echo e($order->total_formatted); ?></span>
                        </div>
                    </div>
                </div>

                
                <!--[if BLOCK]><![endif]--><?php if($order->status == \App\States\SalesOrder\Pending::class): ?>
                    <div
                        class="mt-5 pt-4 border-t border-[#f0f0eb] flex flex-col sm:flex-row items-center justify-between gap-3 no-print">
                        <div class="text-xs text-[#8c9082]">
                            <p class="font-bold text-[#20221b]">Menunggu Pembayaran</p>
                            <p class="text-[11px]">Silakan selesaikan pembayaran sebelum batas waktu berakhir.</p>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php if($is_redirect): ?>
                            <a href="<?php echo e($redirect_url); ?>"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 rounded-xl bg-[#20221b] px-6 py-2.5 text-xs font-bold text-white shadow-xs hover:bg-black transition">
                                Bayar Sekarang &rarr;
                            </a>
                        <?php else: ?>
                            <span
                                class="text-xs font-bold text-amber-800 bg-amber-50 px-3.5 py-1.5 rounded-xl border border-amber-200">
                                Silakan Hubungi CS WhatsApp: 08999999999
                            </span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa92fd5562a0c82e62f2e625d459a2d3)): ?>
<?php $attributes = $__attributesOriginalfa92fd5562a0c82e62f2e625d459a2d3; ?>
<?php unset($__attributesOriginalfa92fd5562a0c82e62f2e625d459a2d3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa92fd5562a0c82e62f2e625d459a2d3)): ?>
<?php $component = $__componentOriginalfa92fd5562a0c82e62f2e625d459a2d3; ?>
<?php unset($__componentOriginalfa92fd5562a0c82e62f2e625d459a2d3); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/sales-order-detail.blade.php ENDPATH**/ ?>