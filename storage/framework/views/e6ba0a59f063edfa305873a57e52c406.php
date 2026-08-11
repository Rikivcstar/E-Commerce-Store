<div>

    <style>
        :root {
            --nx-ink: #111008;
            --nx-paper: #F7F5EF;
            --nx-line: #E1DDD1;
            --nx-muted: #6E6A5E;
            --nx-dark2: #1C1B14;
        }

        .nx-display {
            font-family: 'Viga', Arial, sans-serif
        }

        .nx-mono {
            font-family: 'IBM Plex Mono', ui-monospace, monospace
        }

        .nx-label {
            font-family: 'Inter';
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase
        }

        .nx-photo {
            filter: grayscale(1) contrast(1.04)
        }

        .nx-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            height: 2.85rem;
            padding: 0 1.9rem;
            font-family: 'Inter';
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            text-decoration: none;
            transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease
        }

        .nx-btn:hover {
            transform: translateY(-2px)
        }

        .nx-btn-primary {
            background: var(--nx-ink);
            color: var(--nx-paper)
        }

        .nx-btn-primary:hover {
            background: #000
        }

        .nx-btn-outline {
            background: transparent;
            color: var(--nx-ink);
            border: 1px solid var(--nx-ink)
        }

        .nx-btn-outline:hover {
            background: var(--nx-ink);
            color: var(--nx-paper)
        }

        .nx-link {
            font-family: 'Inter';
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            text-decoration: underline;
            text-underline-offset: 4px
        }

        .nx-card-arrow {
            transition: transform .25s ease
        }

        .nx-card-link:hover .nx-card-arrow {
            transform: translateX(3px)
        }

        a.nx-focus:focus-visible,
        button.nx-focus:focus-visible {
            outline: 2px solid var(--nx-ink);
            outline-offset: 3px
        }

        @media (prefers-reduced-motion: reduce) {

            .nx-btn,
            .nx-card-arrow,
            .group * {
                transition: none !important
            }
        }

        /* Marquee auto-scroll for popular picks */
        .nx-marquee-track {
            animation: nxMarqueeScroll 20s linear infinite;
        }

        @keyframes nxMarqueeScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>


    <section class="w-full" style="background:var(--nx-paper)">
        <style>
            .nx-hero {
                position: relative;
                min-height: calc(100vh - 5rem);
                width: 100%;
                overflow: hidden;
                padding-top: 5rem
            }

            .nx-hero-word {
                position: absolute;
                left: 50%;
                top: 52%;
                z-index: 1;
                transform: translate(-50%, -50%);
                width: 100%;
                text-align: center;
                font-family: 'Viga', sans-serif;
                font-size: clamp(4.5rem, 17vw, 15.5rem);
                line-height: .82;
                color: var(--nx-ink);
                letter-spacing: -.01em;
                text-transform: uppercase;
                white-space: nowrap
            }

            .nx-hero-img {
                position: absolute;
                left: 50%;
                top: 53%;
                z-index: 3;
                width: min(24rem, 34vw);
                transform: translate(-50%, -50%)
            }

            .nx-hero-img img {
                filter: grayscale(1) contrast(1.05);
                width: 100%;
                display: block
            }

            .nx-hero-eyebrow {
                position: absolute;
                left: 3.2rem;
                top: 8rem;
                z-index: 6;
                font-family: 'Viga', sans-serif;
                font-size: .85rem;
                letter-spacing: .22em;
                line-height: 1.55;
                color: var(--nx-ink);
                text-transform: uppercase
            }

            .nx-hero-eyebrow::after {
                content: "";
                display: block;
                width: 2.2rem;
                height: 2px;
                background: var(--nx-ink);
                margin-top: .6rem
            }

            .nx-hero-topline {
                position: absolute;
                inset: 2rem 3rem auto;
                z-index: 4;
                display: flex;
                justify-content: space-between;
                color: var(--nx-muted);
                font-family: 'IBM Plex Mono', monospace;
                font-size: .66rem;
                font-weight: 500;
                letter-spacing: .1em;
                text-transform: uppercase
            }

            .nx-hero-tag {
                position: absolute;
                right: 3.2rem;
                bottom: 5.4rem;
                z-index: 6;
                font-family: 'Viga', sans-serif;
                font-size: .85rem;
                letter-spacing: .16em;
                line-height: 1.5;
                color: var(--nx-ink);
                text-align: right;
                text-transform: uppercase
            }

            .nx-hero-tag::before {
                content: "";
                display: block;
                width: 2.2rem;
                height: 2px;
                background: var(--nx-ink);
                margin: 0 0 .6rem auto
            }

            .nx-hero-actions {
                position: absolute;
                left: 3.2rem;
                bottom: 3.4rem;
                z-index: 7;
                display: flex;
                align-items: center;
                gap: 1.5rem
            }

            @media(max-width:900px) {
                .nx-hero-topline {
                    inset: 1.6rem 1.4rem auto
                }

                .nx-hero-topline span:last-child {
                    display: none
                }

                .nx-hero-eyebrow {
                    left: 1.4rem;
                    top: 6.5rem;
                    font-size: .72rem
                }

                .nx-hero-word {
                    top: 46%;
                    font-size: clamp(3.6rem, 23vw, 8rem)
                }

                .nx-hero-img {
                    top: 50%;
                    width: min(19rem, 66vw)
                }

                .nx-hero-tag {
                    right: 1.4rem;
                    bottom: 8.5rem;
                    font-size: .7rem
                }

                .nx-hero-actions {
                    left: 1.4rem;
                    bottom: 2.4rem
                }
            }

            @media(max-width:640px) {
                .nx-hero {
                    min-height: 42rem
                }

                .nx-hero-eyebrow {
                    display: none
                }

                .nx-hero-word {
                    top: 40%;
                    font-size: 22vw
                }

                .nx-hero-img {
                    top: 47%;
                    width: min(16rem, 72vw)
                }

                .nx-hero-tag {
                    display: none
                }

                .nx-hero-actions {
                    flex-direction: column;
                    align-items: flex-start;
                    bottom: 2.2rem;
                    width: calc(100% - 2.8rem)
                }

                .nx-hero-actions .nx-btn {
                    width: 100%
                }
            }
        </style>
        <div class="nx-hero">
            <div class="nx-hero-topline">
                <span>Free delivery on orders above Rp 500.000</span>
                <span>Track order</span>
            </div>
            <div class="nx-hero-eyebrow">Fashion<br>that moves<br>with you.</div>
            <div class="nx-hero-word">NEXORA</div>
            <img class="nx-hero-img" src="<?php echo e(asset('images/hero-outfit-women.png')); ?>" alt="Nexora collection">
            <div class="nx-hero-tag">New<br>collection<br>2026</div>
            <div class="nx-hero-actions">
                <a class="nx-btn nx-btn-primary nx-focus" href="<?php echo e(route('product-catalog')); ?>">Shop now</a>
                <a class="nx-link nx-focus" href="#featured" style="color:var(--nx-ink)">Explore new in</a>
            </div>
        </div>
    </section>

    
    <!--[if BLOCK]><![endif]--><?php if($banners->isNotEmpty()): ?>
        <section class="w-full bg-[#F7F5EF] py-4 sm:py-6">
            <div class="mx-auto max-w-7xl px-4 sm:px-8 lg:px-16"
                x-data="{
                    current: 0,
                    total: <?php echo e($banners->count()); ?>,
                    timer: null,
                    autoplay() {
                        this.stop();
                        this.timer = setInterval(() => { this.next() }, 5000);
                    },
                    stop() {
                        if (this.timer) clearInterval(this.timer);
                    },
                    next() {
                        this.current = (this.current + 1) % this.total;
                    },
                    prev() {
                        this.current = (this.current - 1 + this.total) % this.total;
                    }
                }"
                x-init="autoplay()"
                @mouseenter="stop()"
                @mouseleave="autoplay()">
                
                <div class="group relative overflow-hidden rounded-2xl shadow-xl" style="background:#1C1B14">
                    
                    <div class="relative min-h-[380px] w-full sm:min-h-[460px] lg:min-h-[480px]">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $bannerImage = $banner->getFirstMediaUrl('image'); ?>
                            <div x-show="current === <?php echo e($index); ?>"
                                x-transition:enter="transition ease-out duration-700 transform"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-500 transform"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute inset-0 size-full">
                                
                                <!--[if BLOCK]><![endif]--><?php if($bannerImage): ?>
                                    <img src="<?php echo e($bannerImage); ?>" alt="<?php echo e($banner->title); ?>"
                                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-1000 group-hover:scale-105" loading="lazy">
                                    <div class="absolute inset-0" style="background:linear-gradient(90deg, rgba(17,16,8,.85) 0%, rgba(17,16,8,.45) 60%, transparent 100%)"></div>
                                <?php else: ?>
                                    <div class="absolute inset-0 flex items-center bg-gradient-to-r from-[#1C1B14] via-[#2A281E] to-[#1C1B14]"></div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <div class="absolute inset-0 flex flex-col items-start justify-center gap-4 px-8 sm:px-14 lg:px-18 max-w-3xl">
                                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3.5 py-1 text-xs font-bold text-[#EBE5D8] backdrop-blur-md border border-white/15">
                                        <span class="size-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        <span>PROMO SPESIAL</span>
                                    </div>
                                    <h2 class="nx-display max-w-2xl text-3xl sm:text-5xl lg:text-6xl leading-[0.95] text-[#F7F5EF] font-black tracking-tight">
                                        <?php echo e($banner->title); ?>

                                    </h2>
                                    <!--[if BLOCK]><![endif]--><?php if($banner->subtitle): ?>
                                        <p class="max-w-xl text-sm sm:text-base text-white/80 font-normal leading-relaxed">
                                            <?php echo e($banner->subtitle); ?>

                                        </p>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <a href="<?php echo e($banner->link_url ?? route('product-catalog')); ?>" class="nx-btn nx-btn-primary nx-focus mt-2 shadow-lg inline-flex items-center">
                                        <span><?php echo e($banner->button_label ?? 'Belanja Sekarang'); ?></span>
                                        <svg class="size-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    
                    <!--[if BLOCK]><![endif]--><?php if($banners->count() > 1): ?>
                        <button type="button" @click="prev()"
                            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 flex size-11 items-center justify-center rounded-full bg-black/40 text-white backdrop-blur-md border border-white/20 opacity-0 group-hover:opacity-100 transition-all hover:bg-white hover:text-black hover:scale-110"
                            aria-label="Previous slide">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button type="button" @click="next()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 flex size-11 items-center justify-center rounded-full bg-black/40 text-white backdrop-blur-md border border-white/20 opacity-0 group-hover:opacity-100 transition-all hover:bg-white hover:text-black hover:scale-110"
                            aria-label="Next slide">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>

                        
                        <div class="absolute bottom-5 right-6 z-20 flex items-center gap-2 bg-black/40 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/15">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" @click="current = <?php echo e($index); ?>"
                                    :class="current === <?php echo e($index); ?> ? 'w-7 bg-white' : 'w-2 bg-white/40 hover:bg-white/70'"
                                    class="h-2 rounded-full transition-all duration-300" aria-label="Slide <?php echo e($index + 1); ?>"></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            <span class="text-[11px] font-bold text-white/80 pl-2 border-l border-white/20" x-text="`${current + 1} / ${total}`"></span>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </section>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    

    
    <section class="w-full py-10" style="background:var(--nx-ink)">
        <div class="mx-auto max-w-7xl px-4 sm:px-8 lg:px-16">
            <div class="grid grid-cols-1 divide-y sm:grid-cols-3 sm:divide-x sm:divide-y-0"
                style="border-color:rgba(247,245,239,.14)">
                <?php $catIcons = ['shirt','shopping-bag','tag','sparkles','layers','grid']; ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $thumb =
                            $category->getFirstMediaUrl('image') ?:
                            $category->products()->first()?->getFirstMediaUrl('cover');
                    ?>
                    <a href="<?php echo e(route('product-catalog', ['selectCategory' => [$category->id]])); ?>"
                        class="group nx-card-link nx-focus flex items-center gap-5 px-2 py-6 transition hover:bg-white/[0.03] sm:px-6">
                        <div class="relative h-20 w-16 shrink-0 overflow-hidden rounded-sm" style="background:#2A281E">
                            <!--[if BLOCK]><![endif]--><?php if($thumb): ?>
                                <img src="<?php echo e($thumb); ?>" alt="<?php echo e($category->name); ?>"
                                    class="nx-photo h-full w-full object-cover transition duration-500 group-hover:scale-110">
                            <?php else: ?>
                                <div class="flex h-full w-full items-center justify-center" style="color:#7A755F">
                                    <i data-lucide="<?php echo e($catIcons[$i % 6]); ?>" class="size-6"></i>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div>
                            <h3 class="nx-display text-lg text-white"><?php echo e($category->name); ?></h3>
                            <p class="mt-1 text-xs" style="color:#96907A">Koleksi pilihan terbaik.</p>
                            <span
                                class="nx-card-arrow nx-link mt-3 inline-flex items-center gap-1 text-white/50 group-hover:text-white">
                                Shop <?php echo e($category->name); ?> &rarr;
                            </span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </section>

    
    <section class="relative w-full overflow-hidden" style="background:#EAE7DD">
        
        <div class="absolute -left-20 top-1/2 -translate-y-1/2 w-80 h-80 rounded-full opacity-[0.06]"
            style="background:var(--nx-ink)"></div>
        <div
            class="mx-auto flex min-h-[420px] max-w-7xl flex-col items-start justify-center gap-6 px-8 py-16 sm:min-h-[480px] sm:px-12 lg:px-16">
            <p class="nx-label" style="color:var(--nx-muted)">New season</p>
            <h2 class="nx-display max-w-sm text-6xl leading-[0.9] sm:text-8xl" style="color:var(--nx-ink)">New<br>Vibes
            </h2>
            <p class="max-w-xs text-sm leading-relaxed" style="color:var(--nx-muted)">Discover everything new and now —
                engineered for daily comfort and bold contemporary style.</p>
            <a href="<?php echo e(route('product-catalog')); ?>" class="nx-btn nx-btn-primary nx-focus mt-2">
                Explore Collection
            </a>
        </div>
        <img src="<?php echo e(asset('images/hero-outfit-men.png')); ?>" alt="New season"
            class="nx-photo absolute bottom-0 right-8 h-[90%] w-auto object-contain object-bottom max-lg:hidden">
    </section>

    
    <section class="w-full border-y py-8" style="background:var(--nx-paper);border-color:var(--nx-line)">
        <div class="mx-auto max-w-7xl px-4 sm:px-8 lg:px-16">
            <div class="grid grid-cols-2 gap-6 sm:gap-8 lg:grid-cols-4">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [['truck', 'Fast Delivery', 'Quick & safe delivery'], ['rotate-ccw', 'Easy Returns', 'Within 15 days'], ['shield-check', 'Quality Assured', 'Best fashion, best quality'], ['lock', 'Secure Payment', '100% secure checkout']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$icon, $title, $desc]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-4">
                        <div class="flex size-11 shrink-0 items-center justify-center rounded-full border"
                            style="border-color:var(--nx-ink)">
                            <i data-lucide="<?php echo e($icon); ?>" class="size-5" style="color:var(--nx-ink)"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider" style="color:var(--nx-ink)">
                                <?php echo e($title); ?></p>
                            <p class="mt-0.5 text-xs" style="color:var(--nx-muted)"><?php echo e($desc); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </section>

    
    <section id="featured" class="w-full py-16 px-4 sm:px-8 lg:px-16" style="background:var(--nx-paper)">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between border-b pb-4" style="border-color:var(--nx-line)">
                <h2 class="nx-display text-2xl sm:text-3xl" style="color:var(--nx-ink)">Best of Nexora</h2>
                <a href="<?php echo e(route('product-catalog')); ?>" class="nx-link nx-focus" style="color:var(--nx-ink)">View
                    All</a>
            </div>
            <div class="grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $feature_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </section>

    
    <section class="w-full py-16 px-4 sm:px-8 lg:px-16" style="background:#EAE7DD">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between">
                <h2 class="nx-display text-2xl sm:text-3xl" style="color:var(--nx-ink)">Collections</h2>
                <a href="<?php echo e(route('product-catalog')); ?>" class="nx-link nx-focus" style="color:var(--nx-ink)">View
                    All</a>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:gap-5 lg:grid-cols-4">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $img = $cat->getFirstMediaUrl('image') ?: $cat->products()->first()?->getFirstMediaUrl('cover');
                    ?>
                    <a href="<?php echo e(route('product-catalog', ['selectCategory' => [$cat->id]])); ?>"
                        class="group nx-card-link nx-focus relative block aspect-square overflow-hidden"
                        style="background:var(--nx-ink)">
                        <!--[if BLOCK]><![endif]--><?php if($img): ?>
                            <img src="<?php echo e($img); ?>" alt="<?php echo e($cat->name); ?>"
                                class="nx-photo h-full w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/15 to-transparent">
                            </div>
                        <?php else: ?>
                            <div class="absolute inset-0" style="background:var(--nx-ink)"></div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
                            <h3 class="nx-display text-lg text-white sm:text-xl"><?php echo e($cat->name); ?></h3>
                            <p class="nx-mono text-[11px] text-white/60"><?php echo e($cat->products_count); ?> produk</p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </section>

    
    <section class="w-full py-16 px-4 sm:px-8 lg:px-16" style="background:var(--nx-paper)">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between border-b pb-4" style="border-color:var(--nx-line)">
                <h2 class="nx-display text-2xl sm:text-3xl" style="color:var(--nx-ink)">New Arrivals</h2>
                <a href="<?php echo e(route('product-catalog')); ?>" class="nx-link nx-focus" style="color:var(--nx-ink)">View
                    All</a>
            </div>
            <div class="grid grid-cols-2 gap-5 sm:gap-6 lg:grid-cols-4">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $latest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div class="mt-12 flex justify-center">
                <a href="<?php echo e(route('product-catalog')); ?>" class="nx-btn nx-btn-outline nx-focus">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    
    <section class="w-full py-16 px-4 sm:px-8 lg:px-16" style="background:#EAE7DD">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-5 lg:grid-cols-2">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $img = $cat->getFirstMediaUrl('image') ?: $cat->products()->first()?->getFirstMediaUrl('cover'); ?>
                    <div class="group relative min-h-[260px] overflow-hidden sm:min-h-[300px]"
                        style="background:var(--nx-ink)">
                        <!--[if BLOCK]><![endif]--><?php if($img): ?>
                            <img src="<?php echo e($img); ?>" alt="<?php echo e($cat->name); ?>"
                                class="nx-photo absolute inset-0 h-full w-full object-cover opacity-55 transition duration-700 group-hover:scale-105">
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <div class="absolute inset-0"
                            style="background:linear-gradient(90deg,rgba(17,16,8,.94) 0%,rgba(17,16,8,.55) 55%,rgba(17,16,8,.1) 100%)">
                        </div>
                        <div class="relative z-10 flex h-full flex-col justify-between p-7 sm:p-8">
                            <div>
                                <span
                                    class="nx-mono inline-block px-3 py-1 text-[10px] font-medium tracking-widest text-white/80 rounded-sm"
                                    style="background:rgba(255,255,255,.12);backdrop-filter:blur(4px)">
                                    <?php echo e($cat->products_count); ?> PRODUK
                                </span>
                                <h3 class="nx-display mt-4 text-3xl text-white sm:text-4xl"><?php echo e($cat->name); ?></h3>
                                <p class="mt-2 max-w-[260px] text-sm leading-relaxed text-white line-clamp-2">
                                    <?php echo e($cat->description ?? 'Jelajahi koleksi pilihan produk terkurasi.'); ?>

                                </p>
                            </div>
                            <a href="<?php echo e(route('product-catalog', ['selectCategory' => [$cat->id]])); ?>"
                                class="nx-btn nx-btn-primary nx-focus mt-8 w-fit"
                                style="background:var(--nx-paper);color:var(--nx-ink)">
                                Lihat Koleksi
                                <i data-lucide="arrow-right" class="size-4"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
        
        <!--[if BLOCK]><![endif]--><?php if(isset($popular_products) && count($popular_products) > 0): ?>
            <section class="w-full py-14 overflow-hidden" style="background:var(--nx-paper)" x-data="{ paused: false }">
                <div class="mx-auto max-w-7xl px-4 sm:px-8 lg:px-16 mb-8">
                    <p class="nx-label" style="color:var(--nx-muted)">Trending Now</p>
                    <h2 class="nx-display text-2xl sm:text-3xl mt-1" style="color:var(--nx-ink)">Pilihan Populer</h2>
                </div>
                <div class="relative" @mouseenter="paused = true" @mouseleave="paused = false">
                    
                    <div class="absolute left-0 top-0 h-full w-16 sm:w-24 z-10 pointer-events-none"
                        style="background:linear-gradient(to right, var(--nx-paper), transparent)"></div>
                    <div class="absolute right-0 top-0 h-full w-16 sm:w-24 z-10 pointer-events-none"
                        style="background:linear-gradient(to left, var(--nx-paper), transparent)"></div>

                    <div class="nx-marquee-track flex w-fit"
                        :style="{ animationPlayState: paused ? 'paused' : 'running' }">
                        <!--[if BLOCK]><![endif]--><?php for($loop_i = 0; $loop_i < 2; $loop_i++): ?>
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $popular_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('product', $pp->slug)); ?>"
                                    class="group relative mx-3 w-52 h-72 flex-shrink-0 overflow-hidden rounded-lg block"
                                    style="background:var(--nx-ink)">
                                    <img src="<?php echo e($pp->cover_url); ?>" alt="<?php echo e($pp->name); ?>"
                                        class="h-full w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100">
                                    <div
                                        class="absolute inset-0 flex items-end p-4 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <p class="text-white text-sm font-semibold leading-snug line-clamp-2">
                                            <?php echo e($pp->name); ?></p>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </section>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
        <!--[if BLOCK]><![endif]--><?php if(isset($static_pages) && $static_pages->count() > 0): ?>
            <section class="w-full py-16 px-4 sm:px-8 lg:px-16" style="background:var(--nx-paper)">
                <div class="mx-auto max-w-7xl">
                    
                    <div class="text-center mb-12">
                        <p class="nx-label" style="color:var(--nx-muted)">Information & Guides</p>
                        <h2 class="nx-display text-2xl sm:text-3xl mt-2" style="color:var(--nx-ink)">Pusat Informasi
                        </h2>
                        <p class="mt-3 text-sm max-w-lg mx-auto leading-relaxed" style="color:var(--nx-muted)">
                            Temukan panduan, kebijakan, dan informasi penting seputar layanan kami untuk pengalaman
                            belanja terbaik.
                        </p>
                    </div>

                    
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $static_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $pageImg = $page->image_url;
                                $pageColors = ['#3B82F6', '#8B5CF6', '#10B981', '#F59E0B', '#EF4444', '#06B6D4'];
                                $pageColor = $pageColors[$loop->index % count($pageColors)];
                            ?>
                            <a href="<?php echo e(route('page', $page->slug)); ?>"
                                class="group nx-card-link nx-focus block rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                                style="background:#fff">
                                
                                <div class="relative aspect-[16/10] w-full overflow-hidden"
                                    style="background:#EAE7DD">
                                    <!--[if BLOCK]><![endif]--><?php if($pageImg): ?>
                                        <img src="<?php echo e($pageImg); ?>" alt="<?php echo e($page->name); ?>"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                    <?php else: ?>
                                        <div class="h-full w-full flex items-center justify-center"
                                            style="background:linear-gradient(135deg, <?php echo e($pageColor); ?>22, <?php echo e($pageColor); ?>44)">
                                            <i data-lucide="file-text" class="size-10"
                                                style="color:<?php echo e($pageColor); ?>"></i>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                
                                <div class="p-5">
                                    <h3 class="nx-display text-lg leading-snug line-clamp-2 transition-colors duration-200 group-hover:opacity-80"
                                        style="color:var(--nx-ink)">
                                        <?php echo e($page->name); ?>

                                    </h3>
                                    <p class="mt-2 text-xs leading-relaxed line-clamp-2"
                                        style="color:var(--nx-muted)">
                                        <?php echo e($page->excerpt ?? 'Klik untuk membaca selengkapnya mengenai ' . $page->name); ?>

                                    </p>
                                    <span
                                        class="nx-card-arrow inline-flex items-center gap-1.5 mt-4 text-xs font-bold uppercase tracking-wider"
                                        style="color:<?php echo e($pageColor); ?>">
                                        Baca &rarr;
                                    </span>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </section>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/home-page.blade.php ENDPATH**/ ?>