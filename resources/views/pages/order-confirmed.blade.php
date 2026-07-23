<x-store-layout>
    @push('head')
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js" defer></script>
        <script type="text/javascript" defer>
            window.addEventListener("load", function() {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: {
                        y: 0.6
                    }
                });
            });
        </script>
    @endpush

    <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="w-full p-5 mx-auto md:w-1/2" data-aos="zoom-in">
            <div class="relative flex flex-col bg-white shadow-lg border border-[#e2e8f0] rounded-2xl">
                <div class="relative overflow-hidden text-center bg-gradient-to-r from-[#0f2d5a] to-[#1e40af] min-h-32 rounded-t-2xl">
                    <!-- SVG Background Element -->
                    <figure class="absolute inset-x-0 bottom-0 -mb-px">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                            viewBox="0 0 1920 100.1">
                            <path fill="currentColor" class="fill-white"
                                d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                        </svg>
                    </figure>
                    <!-- End SVG Background Element -->
                </div>

                <div class="relative z-10 -mt-12">
                    <!-- Icon -->
                    <span
                        class="mx-auto flex justify-center items-center size-16 rounded-full border border-[#e2e8f0] bg-white text-[#1e40af] shadow-md">
                        <svg class="shrink-0 size-6 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                            <path
                                d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </span>
                    <!-- End Icon -->
                </div>

                <!-- Body -->
                <div class="p-6 overflow-y-auto sm:p-8">
                    <div class="text-center">
                        <h3 id="hs-ai-modal-label" class="text-lg font-bold text-[#0f2d5a]">
                            Invoice from {{ config('app.name') }}
                        </h3>
                        <p class="text-sm text-[#4b6489] mt-0.5 font-medium">
                            Invoice #3682303
                        </p>
                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 gap-5 mt-6 sm:mt-8 sm:grid-cols-3 bg-[#f8fafc] border border-[#e2e8f0] p-4 rounded-xl text-center">
                        <div>
                            <span class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider">Amount Paid</span>
                            <span class="block text-sm font-bold text-[#1e40af] mt-1">Rp123.123</span>
                        </div>
                        <!-- End Col -->

                        <div>
                            <span class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider">Date Paid</span>
                            <span class="block text-sm font-bold text-[#0f2d5a] mt-1">April 22, 2020</span>
                        </div>
                        <!-- End Col -->

                        <div>
                            <span class="block text-xs font-semibold text-[#4b6489] uppercase tracking-wider">Payment Method</span>
                            <span class="block text-sm font-bold text-[#0f2d5a] mt-1">Bank Transfer BCA</span>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->

                    <div class="mt-8">
                        <h4 class="text-xs font-bold text-[#0f2d5a] uppercase tracking-wider mb-3">Summary</h4>

                        <ul class="flex flex-col border border-[#e2e8f0] rounded-xl overflow-hidden bg-white shadow-xs">
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>BCA Account Name</span>
                                    <span class="text-[#0f2d5a] font-semibold">Rezza Kurniawan</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Bank Account Number</span>
                                    <span class="text-[#0f2d5a] font-semibold">123123-123</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Unique Code</span>
                                    <span class="text-[#1e40af] font-semibold">Rp123</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3.5 text-sm font-bold text-[#0f2d5a] bg-[#f8fafc]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Total Transfer</span>
                                    <span class="text-[#1e40af] text-base">Rp123.123</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="block my-4 text-center">
                        <p class="text-xs text-[#4b6489] font-medium italic">Please transfer exactly up to the last 3 digits.</p>
                    </div>

                    <!-- Button -->
                    <a href="#"
                        class="block w-full px-4 py-3 font-bold text-center text-white bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg text-sm shadow-md transition-colors duration-250">
                        Check Payment Status
                    </a>
                    <!-- End Buttons -->

                    <div class="my-6 hs-accordion-group border-t border-[#e2e8f0] pt-4">
                        <div class="hs-accordion active" id="hs-basic-with-title-and-arrow-stretched-heading-one">
                            <button
                                class="inline-flex items-center justify-between w-full py-3 font-bold text-[#0f2d5a] rounded-lg hs-accordion-toggle hs-accordion-active:text-[#1e40af] gap-x-3 text-start hover:text-[#1e40af] cursor-pointer"
                                aria-expanded="true"
                                aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                                Product Summary
                                <svg class="block hs-accordion-active:hidden size-4 text-[#4b6489]" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                                <svg class="hidden hs-accordion-active:block size-4 text-[#1e40af]" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"></path>
                                </svg>
                            </button>
                            <div id="hs-basic-with-title-and-arrow-stretched-collapse-one"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 divide-y divide-[#e2e8f0]"
                                role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                                @for ($i = 0; $i <= 5; $i++)
                                    <x-single-product-list />
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-store-layout>
