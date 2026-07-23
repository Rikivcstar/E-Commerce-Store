<div>
  <div class="container mx-auto max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid gap-10 md:grid-cols-10">
            <div class="md:col-span-7">
                <h1 class="mb-6 text-2xl font-extrabold text-[#0f2d5a]">Shopping Bag</h1>
                <div class="grid gap-6">
                    @forelse ($items as $item )
                     <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 pb-6 border-b border-[#e2e8f0]">
                        <div class="relative w-32 h-32 overflow-hidden rounded-xl border border-[#e2e8f0] flex-shrink-0">
                            <img class="object-cover size-full"
                                src="{{ $item->product()->cover_url }}"
                                alt="{{ $item->sku }}">
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                                <div>
                                    <h3 class="text-lg font-bold text-[#0f2d5a]">
                                        {{ $item->product()->name }}
                                    </h3>
                                    <h2 class="text-sm text-[#4b6489] mt-0.5">{{ $item->product()->short_desc }}</h2>
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-xl font-bold text-[#1e40af]">
                                        {{ $item->product()->price_formatted }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <livewire:add-to-card wire:key='add-to-cart-{{ $item->sku }}' :product="$item->product()"/>
                                </div>
                                <div class="flex items-center gap-2">
                                    <livewire:cart-remove :product="$item->product()"/>
                                </div>
                            </div>
                        </div>
                     </div>
                    @empty
                        <div class="font-bold text-[#4b6489] text-lg uppercase flex flex-col justify-center items-center py-10">
                            Your cart is empty
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="md:col-span-3">
                <h1 class="mb-6 text-2xl text-[#0f2d5a] font-extrabold">Order Summary</h1>
                <div class="grid gap-5">
                    <!-- List Group -->
                    <ul class="flex flex-col border border-[#e2e8f0] rounded-xl overflow-hidden bg-white shadow-xs">
                        <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                            <div class="flex items-center justify-between w-full">
                                <span>Sub Total</span>
                                <span class="text-[#0f2d5a] font-semibold">{{ $subTotal }}</span>
                            </div>
                        </li>
                        <li class="inline-flex items-center px-4 py-3 text-sm text-[#4b6489] border-b border-[#e2e8f0]">
                            <div class="flex items-center justify-between w-full">
                                <span>Shipping</span>
                                <span class="text-[#0f2d5a] font-semibold">Free</span>
                            </div>
                        </li>
                        <li class="inline-flex items-center px-4 py-4 text-sm font-bold text-[#0f2d5a] bg-[#f8fafc]">
                            <div class="flex items-center justify-between w-full">
                                <span>Total</span>
                                <span class="text-[#1e40af] text-lg">{{ $total }}</span>
                            </div>
                        </li>
                    </ul>
                    <!-- End List Group -->
                    <button type="button" wire:click='checkout' wire:loading.attr='disabled'
                        class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-bold text-white bg-[#1e40af] hover:bg-[#0f2d5a] border border-transparent rounded-lg cursor-pointer gap-x-2 transition-colors duration-250 shadow-md">
                        Checkout Now
                        <div wire:loading class="animate-spin inline-block size-4 border-3 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                                <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
