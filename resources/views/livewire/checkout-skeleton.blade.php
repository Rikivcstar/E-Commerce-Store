<div style="background-color:#eaeae8;color:#111111;padding:2.5rem clamp(1rem,4vw,3.5rem) 5rem;">
    <div style="max-width:92rem;margin:0 auto;">
        {{-- HEADER SKELETON --}}
        <div class="mb-10">
            <div class="animate-pulse h-[clamp(3rem,8vw,6rem)] w-64 max-w-full rounded-sm bg-neutral-200/80"></div>
        </div>

        <div class="grid items-start gap-10 grid-cols-1 md:[grid-template-columns:minmax(0,1fr)_28rem]">
            {{-- MAIN FORM SKELETON --}}
            <div class="w-full">
                @for ($s = 0; $s < 3; $s++)
                    <section class="mb-10">
                        <div class="animate-pulse mb-5 h-7 w-48 rounded-sm bg-neutral-200/80"></div>
                        {{-- sub header --}}
                        <div class="animate-pulse mb-4 h-4 w-40 rounded-full bg-neutral-200/80"></div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="animate-pulse h-12 w-full border border-[#d4d4d0] bg-[#f4f4f2]"></div>
                            @endfor
                        </div>
                    </section>
                @endfor
            </div>

            {{-- SUMMARY SKELETON --}}
            <aside class="animate-pulse" style="position:sticky;top:6rem;">
                <div class="mb-6 flex items-baseline justify-between">
                    <div class="h-7 w-44 rounded-sm bg-neutral-200/80"></div>
                    <div class="h-3.5 w-10 rounded-full bg-neutral-200/80"></div>
                </div>
                <div class="divide-y divide-neutral-300">
                    @for ($i = 0; $i < 2; $i++)
                        <div class="flex items-center gap-4 py-3">
                            <div class="aspect-[1/1.2] w-16 shrink-0 rounded-sm bg-neutral-200/80"></div>
                            <div class="flex-1 space-y-2">
                                <div class="h-3.5 w-3/4 rounded-full bg-neutral-200/80"></div>
                                <div class="h-3 w-1/2 rounded-full bg-neutral-200/80"></div>
                            </div>
                            <div class="h-4 w-16 rounded-full bg-neutral-200/80"></div>
                        </div>
                    @endfor
                </div>
                <div class="mt-6 flex gap-2">
                    <div class="h-11 flex-1 border border-[#d4d4d0] bg-[#f4f4f2]"></div>
                    <div class="h-11 w-24 border border-[#d4d4d0] bg-[#d8d8d4]"></div>
                </div>
                <div class="mt-6">
                    <x-skeleton.checkout-summary :rows="4" />
                </div>
                <div class="mt-6 h-14 w-full bg-neutral-200/80"></div>
            </aside>
        </div>
    </div>
</div>