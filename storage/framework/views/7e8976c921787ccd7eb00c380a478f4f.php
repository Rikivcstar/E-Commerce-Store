<div>
    <style>
        .ab-shell {
            max-width: 56rem;
            margin: 0 auto;
            padding: 2.5rem clamp(1rem, 4vw, 2.5rem) 5rem;
        }
        .ab-eyebrow {
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #8a8470;
            margin-bottom: 0.5rem;
        }
        .ab-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            text-transform: uppercase;
            color: #111111;
            line-height: 0.88;
            margin-bottom: 2.5rem;
        }
        .ab-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }
        .ab-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.4rem;
            background: #111111;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 1px solid #111111;
            cursor: pointer;
            transition: background 0.2s;
        }
        .ab-add-btn:hover { background: #000; }
        .ab-card {
            border: 1px solid #d4cec4;
            background: #fff;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s;
        }
        .ab-card:hover { box-shadow: 0 4px 18px rgba(40,35,25,0.08); }
        .ab-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #ede9e1;
            flex-wrap: wrap;
        }
        .ab-card-label {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
            font-weight: 900;
            color: #111111;
        }
        .ab-badge {
            font-size: 0.62rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.25rem 0.6rem;
            border: 1px solid #111111;
            background: #111111;
            color: #fff;
        }
        .ab-card-body {
            padding: 1rem 1.25rem;
            font-size: 0.85rem;
            color: #444;
            line-height: 1.7;
        }
        .ab-card-body strong { color: #111; }
        .ab-card-actions {
            display: flex;
            gap: 0.75rem;
            padding: 0.85rem 1.25rem;
            background: #f7f4ee;
            border-top: 1px solid #ede9e1;
        }
        .ab-link-btn {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: none;
            border: none;
            padding: 0.3rem 0;
            cursor: pointer;
            color: #555;
            transition: color 0.2s;
        }
        .ab-link-btn:hover { color: #111; }
        .ab-link-btn.danger { color: #b91c1c; }
        .ab-link-btn.danger:hover { color: #7f1d1d; }
        .ab-empty {
            text-align: center;
            padding: 3.5rem 1rem;
            border: 1px dashed #d4cec4;
            color: #777;
            font-size: 0.9rem;
        }
        /* Form */
        .ab-form {
            border: 1px solid #111;
            background: #fff;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .ab-form-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.25rem;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
        }
        .ab-field-grid {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
        @media (min-width: 640px) {
            .ab-field-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .ab-field-grid .full { grid-column: 1 / -1; }
        }
        .ab-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: #666;
            margin-bottom: 0.35rem;
        }
        .ab-input {
            width: 100%;
            background: #f4f4f2;
            border: 1px solid #d4d4d0;
            padding: 0.7rem 0.9rem;
            font-size: 0.875rem;
            color: #111;
            transition: all 0.2s;
        }
        .ab-input:focus {
            background: #fff;
            border-color: #111;
            outline: none;
            box-shadow: 0 0 0 1px #111;
        }
        .ab-dropdown {
            position: absolute;
            z-index: 30;
            width: 100%;
            margin-top: 0.25rem;
            max-height: 14rem;
            overflow-y: auto;
            border: 1px solid #111;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .ab-dropdown li { padding: 0.7rem 0.9rem; font-size: 0.85rem; cursor: pointer; border-bottom: 1px solid #f0f0f0; }
        .ab-dropdown li:hover { background: #f4f4f2; font-weight: 600; }
        .ab-error { margin-top: 0.3rem; color: #dc2626; font-size: 0.72rem; font-weight: 600; }
        .ab-form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }
        .ab-save-btn {
            padding: 0.7rem 1.5rem;
            background: #111;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 1px solid #111;
            cursor: pointer;
        }
        .ab-cancel-btn {
            padding: 0.7rem 1.5rem;
            background: none;
            color: #555;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border: 1px solid #d4cec4;
            cursor: pointer;
        }
        .ab-selected {
            margin-top: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: #f0ede6;
            border: 1px solid #d4cec4;
            font-size: 0.78rem;
            color: #444;
        }
    </style>

    <div class="ab-shell">
        <p class="ab-eyebrow">My Account</p>
        <h1 class="ab-title">Address<br>Book</h1>

        <div class="ab-toolbar">
            <span class="text-sm text-neutral-500"><?php echo e($addresses->count()); ?> alamat tersimpan</span>
            <!--[if BLOCK]><![endif]--><?php if(! $showForm): ?>
                <button type="button" wire:click="startCreate" class="ab-add-btn">+ Add New Address</button>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!--[if BLOCK]><![endif]--><?php if($showForm): ?>
            <form wire:submit="save" class="ab-form" data-aos="fade-up">
                <div class="ab-form-title"><?php echo e($editingId ? 'Edit Address' : 'New Address'); ?></div>
                <div class="ab-field-grid">
                    <div>
                        <label class="ab-label">Label</label>
                        <input wire:model="form.label" type="text" class="ab-input" placeholder="Rumah / Kantor">
                    </div>
                    <div>
                        <label class="ab-label">Nama Penerima</label>
                        <input wire:model="form.full_name" type="text" class="ab-input" placeholder="Full name">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="ab-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div>
                        <label class="ab-label">No. HP</label>
                        <input wire:model="form.phone" type="text" class="ab-input" placeholder="Phone number">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="ab-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="full">
                        <label class="ab-label">Alamat Lengkap (Jalan, no. rumah, dsb.)</label>
                        <input wire:model="form.address_line" type="text" class="ab-input" placeholder="Street address">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['form.address_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="ab-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="full">
                        <label class="ab-label">Kota / Kecamatan</label>
                        <div x-data="{ open: false }" class="relative w-full">
                            <input type="text" wire:model.live.debounce.500ms="region_selector.keyword"
                                x-on:focus="open = true" x-on:click.outside="open = false"
                                class="ab-input" placeholder="Cari kota atau kecamatan...">
                            <div wire:loading wire:target="region_selector.keyword" class="absolute right-4 top-3.5 inline-block size-4 animate-spin rounded-full border-2 border-current border-t-transparent text-neutral-900" role="status"></div>

                            <!--[if BLOCK]><![endif]--><?php if($this->regions->count() > 0): ?>
                                <ul class="ab-dropdown" x-show="open" x-cloak>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $this->regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li wire:key="ab-region-<?php echo e($region->code); ?>">
                                            <label for="ab-region-<?php echo e($region->code); ?>" class="w-full inline-block cursor-pointer">
                                                <input type="radio" value="<?php echo e($region->code); ?>" wire:model.live="region_selector.region_selected"
                                                    class="sr-only" id="ab-region-<?php echo e($region->code); ?>">
                                                <?php echo e($region->label); ?>

                                            </label>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!--[if BLOCK]><![endif]--><?php if($this->region_selector['region_label']): ?>
                            <div class="ab-selected">Wilayah terpilih: <strong><?php echo e($this->region_selector['region_label']); ?></strong></div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['region_selector.region_selected'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="ab-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="ab-form-actions">
                    <button type="submit" class="ab-save-btn">Simpan Alamat</button>
                    <button type="button" wire:click="cancelEdit" class="ab-cancel-btn">Batal</button>
                </div>
            </form>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="ab-card" data-aos="fade-up">
                <div class="ab-card-head">
                    <div class="ab-card-label">
                        <?php echo e($address->label); ?>

                        <!--[if BLOCK]><![endif]--><?php if($address->is_default): ?>
                            <span class="ab-badge">Utama</span>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <span class="text-xs font-bold text-neutral-400"><?php echo e($address->region_code); ?></span>
                </div>
                <div class="ab-card-body">
                    <div><strong><?php echo e($address->full_name); ?></strong> &middot; <?php echo e($address->phone); ?></div>
                    <div><?php echo e($address->address_line); ?></div>
                    <div><?php echo e($address->sub_district); ?>, <?php echo e($address->district); ?>, <?php echo e($address->city); ?>, <?php echo e($address->province); ?> <?php echo e($address->postal_code); ?></div>
                </div>
                <div class="ab-card-actions">
                    <button type="button" wire:click="startEdit(<?php echo e($address->id); ?>)" class="ab-link-btn">Edit</button>
                    <!--[if BLOCK]><![endif]--><?php if(! $address->is_default): ?>
                        <button type="button" wire:click="setDefault(<?php echo e($address->id); ?>)" class="ab-link-btn">Set Utama</button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <button type="button" wire:click="delete(<?php echo e($address->id); ?>)" wire:confirm="Hapus alamat ini?" class="ab-link-btn danger">Hapus</button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <!--[if BLOCK]><![endif]--><?php if(! $showForm): ?>
                <div class="ab-empty">Belum ada alamat. Tambahkan alamat pertama Anda agar checkout lebih cepat.</div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div><?php /**PATH C:\laraherd\webstore\resources\views/livewire/account/address-book.blade.php ENDPATH**/ ?>