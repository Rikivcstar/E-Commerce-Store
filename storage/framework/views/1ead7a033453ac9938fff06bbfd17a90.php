<header
    x-data="{ scrolled: window.scrollY > 72, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 72, { passive: true })"
    :class="scrolled ? 'px-3 pt-3 sm:px-5 lg:px-8' : 'px-0 pt-0'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-500 ease-out">
    <nav :style="scrolled ? null : 'height: 5rem;'" :class="scrolled ? 'h-16 max-w-[92rem] rounded-[1.35rem] bg-white/90 shadow-lg shadow-[#4d4634]/12 ring-1 ring-black/5' : 'max-w-full rounded-none bg-white/96 shadow-sm shadow-[#4d4634]/8 ring-0'"
        class="mx-auto flex items-center justify-between px-4 backdrop-blur-xl transition-all duration-500 ease-out sm:px-6">
        <a class="group flex items-center gap-3 focus:outline-hidden focus:opacity-80" href="<?php echo e(url('/')); ?>" aria-label="Brand">
            <span :class="scrolled ? 'size-10 rounded-2xl' : 'size-9 rounded-xl'" class="relative flex items-center justify-center bg-[#eef0e7] text-[#555a42] transition-all duration-500">
                <span class="absolute h-0.5 w-6 -rotate-[18deg] rounded-full bg-[#555a42]"></span>
                <span class="absolute mt-2 h-0.5 w-4 -rotate-[18deg] rounded-full bg-[#8d9476]"></span>
            </span>
            <span class="leading-none">
                <span :class="scrolled ? 'text-xl' : 'text-lg'" class="block font-display font-black uppercase tracking-normal text-[#20221b] transition-all duration-500"><?php echo e(config('app.name')); ?></span>
                <span :class="scrolled ? 'opacity-100 translate-y-0 max-h-4' : 'opacity-0 -translate-y-1 max-h-0'" class="mt-1 hidden overflow-hidden text-[10px] font-black uppercase tracking-[0.18em] text-[#878b7c] transition-all duration-500 sm:block">Move ahead</span>
            </span>
        </a>

        <div class="hidden items-center gap-1 md:flex">
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]" href="<?php echo e(url('/')); ?>">Home</a>
<a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]" href="<?php echo e(route('product-catalog')); ?>">Catalog</a>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('category-menu', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]" href="<?php echo e(route('product-catalog')); ?>">New In</a>
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]" href="<?php echo e(route('page')); ?>">Info</a>
        </div>

        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('product-catalog')); ?>" :class="scrolled ? 'size-11' : 'size-10'" class="hidden items-center justify-center rounded-full bg-[#f2f3ed] text-[#555a42] transition-all duration-500 hover:bg-[#e6e8de] sm:flex" aria-label="Cari produk">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21 21-4.34-4.34" /><circle cx="11" cy="11" r="8" />
                </svg>
            </a>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('cart-count', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <button @click="mobileOpen = !mobileOpen" type="button"
                :class="scrolled ? 'size-11' : 'size-10'"
                class="flex items-center justify-center rounded-full bg-[#f2f3ed] text-[#555a42] transition-all duration-500 hover:bg-[#e6e8de] md:hidden"
                aria-label="Toggle navigation">
                <svg x-show="!mobileOpen" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" x2="21" y1="6" y2="6" /><line x1="3" x2="21" y1="12" y2="12" /><line x1="3" x2="21" y1="18" y2="18" />
                </svg>
                <svg x-show="mobileOpen" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" /><path d="m6 6 12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <div x-show="mobileOpen" x-transition :class="scrolled ? 'mt-2 max-w-[92rem] rounded-[1.25rem]' : 'mt-0 max-w-full rounded-none'" class="mx-auto bg-white/95 p-2 shadow-lg shadow-[#555a42]/10 ring-1 ring-black/5 backdrop-blur-xl transition-all duration-500 md:hidden">
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]" href="<?php echo e(url('/')); ?>">Home</a>
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]" href="<?php echo e(route('product-catalog')); ?>">Catalog</a>
        <div class="mt-1 border-t border-black/5 px-4 py-2">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('category-menu', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]" href="<?php echo e(route('product-catalog')); ?>">New In</a>
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]" href="<?php echo e(route('page')); ?>">Info</a>
    </div>
</header>
<?php /**PATH C:\laraherd\webstore\resources\views/components/navigation.blade.php ENDPATH**/ ?>