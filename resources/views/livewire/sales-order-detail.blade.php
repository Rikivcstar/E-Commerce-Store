<div>
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
                            Invoice {{ $order->trx_id }}
                        </p>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xs font-bold text-[#0f2d5a] uppercase tracking-wider mb-3">Summary</h4>

                        <ul class="flex flex-col border border-[#e2e8f0] rounded-xl overflow-hidden bg-white shadow-xs">
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Customer Name</span>
                                    <span class="text-[#0f2d5a] font-semibold">{{$order->customer->full_name}}</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Due date</span>
                                    <span class="text-[#0f2d5a] font-semibold">{{ $order->due_date_at->diffForHumans() }} - {{ $order->due_date_at }}</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Payment Method</span>
                                    <span class="text-[#1e40af] font-semibold">{{$order->payment->label}}</span>
                                </div>
                            </li>
                            <li class="inline-flex items-center px-4 py-3.5 text-sm font-bold text-[#0f2d5a] bg-[#f8fafc]">
                                <div class="flex items-center justify-between w-full">
                                    <span>Total Transfer</span>
                                    <span class="text-[#1e40af] text-base">{{$order->total_formatted}}</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                  @if($is_redirect)
                    <!-- Button -->
                    <a href="{{ $redirect_url }}"
                        class="block w-full px-4 py-3 font-bold text-center text-white bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg text-sm shadow-md transition-colors duration-250">
                        Pay Now
                    </a>

                    @else
                        <span>Silahkan Hubungi Cs Wa : 08999999999  </span>
                    @endif
                    <!-- End Buttons -->


                </div>
            </div>
        </div>
    </div>
</x-store-layout>

</div>
