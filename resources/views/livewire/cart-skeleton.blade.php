<div style="background-color:#eaeae8;color:#111111;padding:2.5rem clamp(1rem,4vw,3.5rem) 5rem;min-height:80vh;">
    <div style="max-width:92rem;margin:0 auto;">
        {{-- BREADCRUMB SKELETON --}}
        <div class="mb-6 flex items-center gap-2">
            <div class="animate-pulse h-3 w-12 rounded-full bg-neutral-200/80"></div>
            <div class="h-3 w-2 bg-neutral-200/80"></div>
            <div class="animate-pulse h-3 w-24 rounded-full bg-neutral-200/80"></div>
        </div>

        {{-- HEADER SKELETON --}}
        <div class="mb-8 border-b border-[#d4d4d0] pb-6">
            <div class="animate-pulse h-[clamp(2.5rem,7vw,5.5rem)] w-72 max-w-full rounded-sm bg-neutral-200/80"></div>
            <div class="animate-pulse mt-4 h-3.5 w-24 rounded-full bg-neutral-200/80"></div>
        </div>

        <div class="grid items-start gap-10 grid-cols-1 md:[grid-template-columns:minmax(0,1fr)_24rem]">
            {{-- CART ITEMS SKELETON --}}
            <section class="space-y-0">
                @for ($i = 0; $i < 3; $i++)
                    <div class="animate-pulse grid gap-6 border-b border-[#d4d4d0] py-6 sm:[grid-template-columns:8rem_minmax(0,1fr)]">
                        <div class="aspect-[3/4] w-full rounded-sm bg-neutral-200/80 sm:w-32 sm:aspect-[3/4]"></div>
                        <div class="flex flex-col justify-between py-1">
                            <div class="space-y-3">
                                <div class="h-5 w-2/3 rounded-full bg-neutral-200/80"></div>
                                <div class="h-3.5 w-1/2 rounded-full bg-neutral-200/80"></div>
                                <div class="h-5 w-24 rounded-full bg-neutral-200/80"></div>
                            </div>
                            <div class="mt-6 pt-4">
                                <div class="h-10 w-40 rounded-full bg-neutral-200/80"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </section>

            {{-- ORDER SUMMARY SKELETON --}}
            <aside class="animate-pulse border border-[#d4d4d0] bg-[#f4f4f2] p-7" style="position:sticky;top:6rem;">
                <div class="mb-5 border-b border-[#d4d4d0] pb-3">
                    <div class="h-6 w-44 rounded-sm bg-neutral-200/80"></div>
                </div>
                <x-skeleton.checkout-summary :rows="3" />
                <div class="mt-6 h-12 w-full bg-neutral-200/80"></div>
                <div class="mt-3 h-11 w-full border border-neutral-200 bg-transparent"></div>
            </aside>
        </div>
    </div>
</div>