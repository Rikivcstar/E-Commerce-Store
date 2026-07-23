<div>
    
    <section class="relative min-h-[85vh] flex items-center overflow-hidden bg-[#0f2d5a]"
        x-data="{
            active: 0,
            slides: [
                { subtitle: 'New Collection 2026', title: 'Elevate Your', highlight: 'Style', desc: 'Discover curated collections that blend timeless elegance with modern trends. Every piece tells a story of craftsmanship and quality.', image: '<?php echo e(asset('images/carousel_bg_1.png')); ?>' },
                { subtitle: 'Premium Quality', title: 'Crafted For The', highlight: 'Modern You', desc: 'Experience fashion that transcends trends. Our pieces are designed with meticulous attention to detail and premium materials.', image: '<?php echo e(asset('images/carousel_bg_2.png')); ?>' },
                { subtitle: 'Limited Edition', title: 'Express Your', highlight: 'Identity', desc: 'Stand out from the crowd with our exclusive limited edition pieces. Bold designs for those who dare to be different.', image: '<?php echo e(asset('images/carousel_bg_3.png')); ?>' }
            ],
            autoplay: null,
            init() {
                this.autoplay = setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length
                }, 6000)
            },
            pause() { clearInterval(this.autoplay) },
            resume() {
                clearInterval(this.autoplay)
                this.autoplay = setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length
                }, 6000)
            },
            prev() {
                this.active = (this.active - 1 + this.slides.length) % this.slides.length
            },
            next() {
                this.active = (this.active + 1) % this.slides.length
            }
        }"
        @mouseenter="pause()"
        @mouseleave="resume()"
    >
        
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="active === index"
                x-transition:enter="transition-all duration-1000 ease-out"
                x-transition:enter-start="opacity-0 scale-[1.02]"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition-all duration-700 ease-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-[0.98]"
                class="absolute inset-0 flex items-center">

                
                <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000"
                     :style="'background-image: linear-gradient(to bottom, rgba(15, 45, 90, 0.75), rgba(15, 45, 90, 0.85)), url(' + slide.image + ')'">
                </div>

                <div class="relative max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 w-full pt-24 pb-16 flex justify-center text-center">
                    <div class="max-w-3xl flex flex-col items-center justify-center">
                        <span x-text="slide.subtitle"
                            class="inline-block text-xs font-semibold text-blue-200 tracking-[0.2em] uppercase mb-6 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-xs">
                        </span>
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight tracking-tight">
                            <span x-text="slide.title"></span>
                            <br>
                            <span class="text-blue-200" x-text="slide.highlight"></span>
                        </h1>
                        <p x-text="slide.desc"
                            class="mt-6 text-base md:text-lg text-white/70 max-w-xl leading-relaxed">
                        </p>
                        <div class="flex flex-wrap gap-4 mt-10 justify-center">
                            <a href="<?php echo e(route('product-catalog')); ?>"
                                class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-[#0f2d5a] font-bold rounded-xl hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-sm">
                                Shop Now
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                                </svg>
                            </a>
                            <a href="<?php echo e(route('product-catalog')); ?>"
                                class="inline-flex items-center gap-2 px-8 py-3.5 border border-white/25 text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-0.5 text-sm backdrop-blur-xs">
                                Explore Collection
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex items-center gap-6 z-20">
            <button @click="prev()" class="text-white/40 hover:text-white transition-colors duration-200 cursor-pointer">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <div class="flex gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="active = index"
                        :class="active === index ? 'bg-white w-8' : 'bg-white/30 w-2'"
                        class="h-2 rounded-full transition-all duration-500 cursor-pointer">
                    </button>
                </template>
            </div>
            <button @click="next()" class="text-white/40 hover:text-white transition-colors duration-200 cursor-pointer">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-white/30 z-20">
            <div class="w-4 h-7 border border-white/25 rounded-full flex justify-center">
                <div class="w-0.5 h-2 bg-white/50 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0 z-10">
            <svg viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-8 md:h-10">
                <path d="M0 40L60 34.7C120 29.3 240 18.7 360 16C480 13.3 600 18.7 720 21.3C840 24 960 24 1080 21.3C1200 18.7 1320 13.3 1380 10.7L1440 8V40H1380C1320 40 1200 40 1080 40C960 40 840 40 720 40C600 40 480 40 360 40C240 40 120 40 60 40H0Z" fill="white"/>
            </svg>
        </div>
    </section>

    
    <section class="border-b border-[#e2e8f0] bg-[#f8fafc]">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto py-3.5">
            <div class="flex items-center gap-8 overflow-x-auto scrollbar-hide">
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-semibold text-[#1e40af] pb-1 border-b-2 border-[#1e40af] whitespace-nowrap">All Products</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">New Arrivals</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Best Sellers</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Sale</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Accessories</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Electronik</a>
                <a href="<?php echo e(route('product-catalog')); ?>" class="flex-shrink-0 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] pb-1 border-b-2 border-transparent hover:border-[#1e40af] whitespace-nowrap transition-all duration-200">Phasion</a>
            </div>
        </div>
    </section>

    
    <section class="py-10 bg-white">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="bg-[#f8fafc] border border-[#e2e8f0] rounded-2xl p-6 md:p-8" data-aos="fade-up">
                <div class="grid items-center gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white transition-colors duration-300 group">
                        <div class="shrink-0 size-12 bg-[#1e40af]/10 rounded-full flex items-center justify-center group-hover:bg-[#1e40af]/15 transition-colors duration-300">
                            <svg class="size-6 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-[#0f2d5a]">Secure Checkout</h3>
                            <p class="text-xs text-[#4b6489] mt-0.5">Protected payments</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white transition-colors duration-300 group">
                        <div class="shrink-0 size-12 bg-[#1e40af]/10 rounded-full flex items-center justify-center group-hover:bg-[#1e40af]/15 transition-colors duration-300">
                            <svg class="size-6 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                                <path d="M15 18H9" />
                                <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                                <circle cx="17" cy="18" r="2" /><circle cx="7" cy="18" r="2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-[#0f2d5a]">Free Shipping</h3>
                            <p class="text-xs text-[#4b6489] mt-0.5">On all orders</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white transition-colors duration-300 group">
                        <div class="shrink-0 size-12 bg-[#1e40af]/10 rounded-full flex items-center justify-center group-hover:bg-[#1e40af]/15 transition-colors duration-300">
                            <svg class="size-6 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-[#0f2d5a]">30 Days Return</h3>
                            <p class="text-xs text-[#4b6489] mt-0.5">No questions asked</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white transition-colors duration-300 group">
                        <div class="shrink-0 size-12 bg-[#1e40af]/10 rounded-full flex items-center justify-center group-hover:bg-[#1e40af]/15 transition-colors duration-300">
                            <svg class="size-6 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-[#0f2d5a]">24/7 Support</h3>
                            <p class="text-xs text-[#4b6489] mt-0.5">Dedicated team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-14">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <span class="inline-block text-xs font-semibold text-[#1e40af] tracking-[0.15em] uppercase mb-2">Featured</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#0f2d5a] tracking-tight">Featured Products</h2>
                    <p class="mt-1 text-sm text-[#4b6489]">Handpicked favorites just for you</p>
                </div>
                <a href="<?php echo e(route('product-catalog')); ?>" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200 group">
                    View All
                    <svg class="size-4 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-5">
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
            <div class="mt-8 text-center sm:hidden">
                <a href="<?php echo e(route('product-catalog')); ?>" class="inline-flex items-center gap-1.5 text-sm font-medium text-[#1e40af] transition-colors duration-200">
                    View All Products
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    
    <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="border-t border-[#e2e8f0]"></div>
    </div>

    
    <section class="py-14">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <span class="inline-block text-xs font-semibold text-[#1e40af] tracking-[0.15em] uppercase mb-2">Latest</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#0f2d5a] tracking-tight">New Arrivals</h2>
                    <p class="mt-1 text-sm text-[#4b6489]">The freshest styles dropped this week</p>
                </div>
                <a href="<?php echo e(route('product-catalog')); ?>" class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-[#4b6489] hover:text-[#1e40af] transition-colors duration-200 group">
                    View All
                    <svg class="size-4 group-hover:translate-x-1 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-5">
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
            <div class="mt-8 text-center sm:hidden">
                <a href="<?php echo e(route('product-catalog')); ?>" class="inline-flex items-center gap-1.5 text-sm font-medium text-[#1e40af] transition-colors duration-200">
                    View All Products
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    
    <section class="pb-16 bg-[#f0f4f9]">
        <div class="max-w-[90rem] px-4 sm:px-6 lg:px-8 mx-auto pt-16">
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0f2d5a] to-[#1e40af] p-10 md:p-14 text-center" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
                <div class="relative">
                    <span class="inline-block text-blue-200 text-xs font-semibold tracking-widest uppercase mb-3">Exclusive Deals</span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Ready to Refresh Your Wardrobe?</h2>
                    <p class="mt-3 text-sm text-white/60 max-w-lg mx-auto">Explore our full collection and discover pieces that speak to your unique style.</p>
                    <a href="<?php echo e(route('product-catalog')); ?>"
                        class="inline-flex items-center gap-2 mt-8 px-8 py-3.5 bg-white text-[#0f2d5a] font-bold rounded-xl hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 text-sm">
                        Browse All Products
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php /**PATH C:\laraherd\webstore\resources\views/livewire/home-page.blade.php ENDPATH**/ ?>