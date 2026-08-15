<header x-data="{ scrolled: window.scrollY > 72, mobileOpen: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 72, { passive: true })" :class="scrolled ? 'px-3 pt-3 sm:px-5 lg:px-8' : 'px-0 pt-0'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-500 ease-out">
    <nav :style="scrolled ? null : 'height: 5rem;'"
        :class="scrolled ?
            'h-16 max-w-[92rem] rounded-[1.35rem] bg-white/90 shadow-lg shadow-[#4d4634]/12 ring-1 ring-black/5' :
            'max-w-full rounded-none bg-white/96 shadow-sm shadow-[#4d4634]/8 ring-0'"
        class="mx-auto flex items-center justify-between px-4 backdrop-blur-xl transition-all duration-500 ease-out sm:px-6">
        <a class="group flex items-center gap-3 focus:outline-hidden focus:opacity-80" href="<?php echo e(url('/')); ?>"
            aria-label="Brand">
            <img src="<?php echo e(asset('images/logo.png')); ?>" :class="scrolled ? 'size-10' : 'size-9'"
                class="object-contain rounded-full transition-all duration-500 shadow-xs border border-amber-900/10 bg-white" alt="<?php echo e(config('app.name')); ?>">
            <span class="leading-none">
                <span :class="scrolled ? 'text-xl' : 'text-lg'"
                    class="block font-display font-black uppercase tracking-normal text-[#20221b] transition-all duration-500"><?php echo e(config('app.name')); ?></span>
                <span :class="scrolled ? 'opacity-100 translate-y-0 max-h-4' : 'opacity-0 -translate-y-1 max-h-0'"
                    class="mt-1 hidden overflow-hidden text-[10px] font-black uppercase tracking-[0.18em] text-[#878b7c] transition-all duration-500 sm:block">Curated Goods</span>
            </span>
        </a>

        <div class="hidden items-center gap-1 md:flex">
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]"
                href="<?php echo e(url('/')); ?>">Home</a>
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]"
                href="<?php echo e(route('product-catalog')); ?>">Catalog</a>
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
            <?php
                $firstPage = \App\Models\Page::query()->active()->first();
            ?>
            <a class="relative inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]"
                href="<?php echo e(route('product-catalog', ['shortBy' => 'price_asc'])); ?>">
                Sale
                <span class="relative flex size-1.5">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex size-1.5 rounded-full bg-red-500"></span>
                </span>
            </a>
            <a class="rounded-full px-4 py-2 text-sm font-bold text-[#555a42] transition hover:bg-[#f2f3ed] hover:text-[#20221b]"
                href="<?php echo e($firstPage ? route('page', $firstPage->slug) : url('/')); ?>">About</a>
        </div>

        <div class="flex items-center gap-2">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('global-search', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

            <?php if(auth()->guard()->check()): ?>
                <?php
                    $userInitials = strtoupper(substr(trim(auth()->user()->name ?? 'User'), 0, 1));
                ?>
                <div x-data="{ userMenuOpen: false }" class="relative hidden sm:block">
                    <button @click="userMenuOpen = !userMenuOpen" @click.outside="userMenuOpen = false" type="button"
                        class="group flex items-center gap-2.5 rounded-full py-2 px-2 text-black transition-all duration-300 hover:opacity-60 shadow-md"
                        aria-label="User Account" title="<?php echo e(auth()->user()->name); ?>">
                        <span
                            class="flex size-7 shrink-0 items-center justify-center rounded-full text-sm font-black text-slate-900 leading-none shadow-xs">
                            <?php echo e($userInitials); ?>

                        </span>
                    </button>

                    <div x-show="userMenuOpen" x-transition style="display: none;"
                        class="absolute right-0 mt-2 w-52 rounded-2xl bg-white p-2 shadow-2xl ring-1 ring-black/10 z-50">
                        <div class="px-3 py-3 border-b border-gray-100 rounded-xl mb-1">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Signed in as</p>
                            <p class="text-xs font-black text-gray-900 truncate"><?php echo e(auth()->user()->name); ?></p>
                        </div>
                        <a href="<?php echo e(route('account.orders')); ?>"
                            class="flex items-center gap-2.5 rounded-full px-3 py-3 text-xs font-bold text-gray-700 hover:bg-[#f2f3ed] hover:opacity-60 transition">
                            <svg class="size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m7.5 4.27 9 5.15" />
                                <path
                                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                <path d="m3.3 7 8.7 5 8.7-5" />
                                <path d="M12 12v9.5" />
                            </svg>
                            My Orders
                        </a>
                        <a href="<?php echo e(route('account.wishlist')); ?>"
                            class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#f2f3ed] hover:text-black transition">
                            <svg class="size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>
                            My Wishlist
                        </a>
                        <a href="<?php echo e(route('account.addresses')); ?>"
                            class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-xs font-bold text-gray-700 hover:bg-[#f2f3ed] hover:text-black transition">
                            <svg class="size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Addresses
                        </a>
                        <form id="nav-desktop-logout-form" method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="button" onclick="confirmLogout('nav-desktop-logout-form')"
                                class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 transition">
                                <svg class="size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" x2="9" y1="12" y2="12" />
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                    class="hidden sm:inline-flex items-center justify-center gap-2 px-3 py-3 rounded-full  text-slate-900 text-xs font-bold uppercase tracking-wider hover:opacity-60 transition shadow-md"
                    aria-label="Sign In" title="Sign In">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </a>
            <?php endif; ?>

            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wishlist-count', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('cart-count', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            <button @click="mobileOpen = !mobileOpen" type="button" :class="scrolled ? 'size-11' : 'size-10'"
                class="flex items-center justify-center rounded-full bg-[#f2f3ed] text-[#555a42] transition-all duration-500 hover:bg-[#e6e8de] md:hidden"
                aria-label="Toggle navigation">
                <svg x-show="!mobileOpen" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" x2="21" y1="6" y2="6" />
                    <line x1="3" x2="21" y1="12" y2="12" />
                    <line x1="3" x2="21" y1="18" y2="18" />
                </svg>
                <svg x-show="mobileOpen" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <div x-show="mobileOpen" x-transition
        :class="scrolled ? 'mt-2 max-w-[92rem] rounded-[1.25rem]' : 'mt-0 max-w-full rounded-none'"
        class="mx-auto bg-white/95 p-2 shadow-lg shadow-[#555a42]/10 ring-1 ring-black/5 backdrop-blur-xl transition-all duration-500 md:hidden">
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
            href="<?php echo e(url('/')); ?>">Home</a>
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
            href="<?php echo e(route('product-catalog')); ?>">Catalog</a>
        <div class="mt-1 border-t border-black/5 px-4 py-2">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('category-menu', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3744725179-4', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <a class="flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
            href="<?php echo e(route('product-catalog', ['shortBy' => 'price_asc'])); ?>">
            Sale
            <span class="relative flex size-1.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex size-1.5 rounded-full bg-red-500"></span>
            </span>
        </a>
        <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
            href="<?php echo e($firstPage ? route('page', $firstPage->slug) : url('/')); ?>">About</a>
        <?php if(auth()->guard()->check()): ?>
            <?php
                $userInitials = strtoupper(substr(trim(auth()->user()->name ?? 'User'), 0, 1));
            ?>
            <div class="mt-2 border-t border-black/5 pt-2">
                <div class="flex items-center gap-3 px-4 py-2">
                    <span
                        class="flex size-8 shrink-0 items-center justify-center rounded-full bg-neutral-900 text-xs font-black text-white">
                        <?php echo e($userInitials); ?>

                    </span>
                    <div>
                        <p class="text-xs font-black text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-[10px] text-emerald-600 font-bold">● Active Customer</p>
                    </div>
                </div>
                <a class="block rounded-2xl px-4 py-2.5 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
                    href="<?php echo e(route('account.orders')); ?>">My Orders</a>
                <a class="block rounded-2xl px-4 py-2.5 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
                    href="<?php echo e(route('account.wishlist')); ?>">My Wishlist</a>
                <a class="block rounded-2xl px-4 py-2.5 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
                    href="<?php echo e(route('account.addresses')); ?>">Addresses</a>
                <form id="nav-mobile-logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="px-4 py-1">
                    <?php echo csrf_field(); ?>
                    <button type="button" onclick="confirmLogout('nav-mobile-logout-form')"
                        class="w-full text-left text-sm font-bold text-red-600 hover:text-red-800 py-1">Sign Out</button>
                </form>
            </div>
        <?php else: ?>
            <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
                href="<?php echo e(route('login')); ?>">Sign In</a>
            <a class="block rounded-2xl px-4 py-3 text-sm font-bold text-[#555a42] hover:bg-[#f2f3ed]"
                href="<?php echo e(route('register')); ?>">Create Account</a>
        <?php endif; ?>
    </div>
</header>
<?php /**PATH C:\laraherd\webstore\resources\views/components/navigation.blade.php ENDPATH**/ ?>