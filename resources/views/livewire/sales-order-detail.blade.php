<div>
    <x-layouts.app>
        @push('head')
            <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js" defer></script>
            <script type="text/javascript" defer>
                window.addEventListener("load", function() {
                    confetti({
                        particleCount: 60,
                        spread: 50,
                        origin: {
                            y: 0.6
                        }
                    });
                });
            </script>
            <style>
                @media print {

                    header,
                    footer,
                    .no-print {
                        display: none !important;
                    }

                    body {
                        background: white !important;
                        padding: 0 !important;
                    }

                    .print-container {
                        width: 100% !important;
                        max-width: 100% !important;
                        box-shadow: none !important;
                        border: none !important;
                    }
                }
            </style>
        @endpush

        <div class="container mx-auto max-w-2xl px-3 sm:px-5 py-6">
            <div class="print-container relative overflow-hidden rounded-2xl bg-white p-5 sm:p-6 shadow-md border border-[#e2e8f0]">

                <div
                    class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-[#f0f0eb] pb-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#20221b] text-white shadow-xs">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                                <path d="m3.3 7 8.7 5 8.7-5" />
                                <path d="M12 12v9.5" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h1 class="font-display text-lg sm:text-xl font-black text-[#20221b] tracking-tight">
                                    Order {{ $order->trx_id }}
                                </h1>
                                @php
                                    $statusBg = match (true) {
                                        str_contains(strtolower($order->status_label ?? ''), 'selesai')
                                            => 'bg-[#555a42]/10 text-[#555a42] border-[#555a42]/20',
                                        str_contains(strtolower($order->status_label ?? ''), 'batal')
                                            => 'bg-rose-50 text-rose-700 border-rose-200',
                                        str_contains(strtolower($order->status_label ?? ''), 'proses')
                                            => 'bg-blue-50 text-blue-700 border-blue-200',
                                        default => 'bg-amber-50 text-amber-800 border-amber-200',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wider {{ $statusBg }}">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                            <p class="text-[11px] font-medium text-[#8c9082]">
                                Dibuat pada {{ $order->created_at_formatted }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 no-print">
                        @if ($can_download_invoice)
                            <a href="{{ route('account.orders.invoice', $order->trx_id) }}"
                                class="inline-flex items-center gap-1.5 rounded-xl bg-[#f2f3ed] mb-5 px-3 py-2 text-xs font-bold text-[#555a42] hover:bg-[#e6e8de] transition">
                                <svg class="size-3.5 text-[#555a42]" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>{{ __('Invoice') }}</a>
                        @endif
                        <button onclick="window.print()" type="button"
                            class="inline-flex items-center gap-1.5 rounded-xl bg-[#f2f3ed] mb-5 px-3 py-2 text-xs font-bold text-[#555a42] hover:bg-[#e6e8de] transition">
                            <svg class="size-3.5 text-[#555a42]" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9" />
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                <rect width="12" height="8" x="6" y="14" />
                            </svg>{{ __('Cetak') }}</button>
                    </div>
                </div>

                @if ($can_claim_order)
                    <div class="mt-5 rounded-2xl bg-[#20221b] text-white p-5 no-print">
                        <h2 class="font-display text-base font-black">{{ __('Simpan pesanan ini ke akun Anda') }}</h2>
                        <p class="mt-1 text-xs text-white/70 leading-relaxed">
                            Buat akun dengan email
                            atau masuk ke akun yang sudah ada. Pesanan checkout-tamu Anda akan otomatis tersimpan di
                            My Orders agar bisa dilacak kapan saja.
                        </p>
                        <div class="mt-4 flex flex-col sm:flex-row gap-2.5">
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-white text-[#20221b] px-5 py-2.5 text-xs font-black transition hover:bg-[#f2f3ed]">
                                Buat Akun &amp; Simpan
                            </a>
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-white/40 px-5 py-2.5 text-xs font-black text-white uppercase tracking-wider transition hover:bg-white/10">{{ __('Masuk') }}</a>
                        </div>
                    </div>
                @endif

                <div class="mt-5">
                    <div class="flex items-center justify-between mb-2.5">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.14em] text-[#8c9082]">{{ __('Order Tracking') }}</h2>
                        @if (!empty($order->shipping->estimated_delivery))
                            <span class="text-[9px] font-bold text-[#555a42] bg-[#f2f3ed] px-2 py-0.5 rounded-full">
                                Estimasi: {{ $order->shipping->estimated_delivery }}
                            </span>
                        @endif
                    </div>

                    <div class="rounded-xl bg-[#f7f7f2] p-3 border border-[#e8e9e1]">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                            @php
                                $steps = [
                                    [
                                        'name' => 'Pesanan Dibuat',
                                        'desc' => $order->created_at_formatted,
                                        'active' => true,
                                    ],
                                    [
                                        'name' => 'Pembayaran',
                                        'desc' => 'Tempo: ' . $order->due_date_at_formatted,
                                        'active' => true,
                                    ],
                                    [
                                        'name' => 'Pengiriman',
                                        'desc' => $order->shipping->courier ?? 'Kurir Ekspres',
                                        'active' =>
                                            str_contains(strtolower($order->status_label ?? ''), 'proses') ||
                                            str_contains(strtolower($order->status_label ?? ''), 'selesai'),
                                    ],
                                    [
                                        'name' => 'Selesai',
                                        'desc' => 'Terkirim',
                                        'active' => str_contains(strtolower($order->status_label ?? ''), 'selesai'),
                                    ],
                                ];
                            @endphp
                            @foreach ($steps as $i => $st)
                                <div class="flex flex-col items-start gap-0.5 min-w-0">
                                    <div class="flex items-center gap-1.5 min-w-0 w-full">
                                        <span
                                            class="flex size-4.5 shrink-0 items-center justify-center rounded-full text-[9px] font-bold {{ $st['active'] ? 'bg-[#555a42] text-white' : 'bg-[#e6e8de] text-[#8c9082]' }}">
                                            @if ($st['active'])
                                                ✓
                                            @else
                                                {{ $i + 1 }}
                                            @endif
                                        </span>
                                        <span
                                            class="text-[10px] sm:text-[11px] font-bold truncate min-w-0 {{ $st['active'] ? 'text-[#20221b]' : 'text-[#8c9082]' }}">
                                            {{ $st['name'] }}
                                        </span>
                                    </div>
                                    <p class="text-[9px] font-medium text-[#8c9082] leading-tight pl-6 truncate w-full">
                                        {{ $st['desc'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082] mb-2.5">{{ __('Riwayat Status') }}</h2>
                    <div class="rounded-xl bg-[#f7f7f2] p-4 border border-[#e8e9e1]">
                        <ol class="space-y-0">
                            @foreach ($timeline as $tl)
                                <li class="relative flex gap-3 pb-5 last:pb-0">
                                    @if (! $loop->last)
                                        <span class="absolute left-[9px] top-5 bottom-0 w-px bg-[#d8dac9]"></span>
                                    @endif
                                    <span
                                        class="relative mt-1 flex size-2.5 shrink-0 rounded-full border-2 border-[#555a42] bg-[#f7f7f2]"></span>
                                    <div class="min-w-0 pt-0.5">
                                        <p class="text-xs font-bold text-[#20221b]">{{ $tl['label'] }}</p>
                                        <p class="text-[10px] font-medium text-[#8c9082]">
                                            {{ ($tl['timestamp'] ?? null)?->translatedFormat('d F Y, H:i') }}
                                        </p>
                                        @if (! empty($tl['description']))
                                            <p class="mt-0.5 text-[11px] text-[#555a42] leading-relaxed">
                                                {{ $tl['description'] }}
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div
                    class="mt-3.5 grid grid-cols-2 md:grid-cols-4 gap-2.5 p-3 rounded-xl bg-[#f7f7f2] border border-[#e8e9e1]">
                    <div class="min-w-0">
                        <span class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">{{ __('Tanggal') }}</span>
                        <span
                            class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate">{{ $order->created_at_formatted }}</span>
                    </div>
                    <div class="min-w-0">
                        <span
                            class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">{{ __('Pembayaran') }}</span>
                        <span class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate"
                            title="{{ $order->payment->label }}">{{ $order->payment->label }}</span>
                    </div>
                    <div class="min-w-0">
                        <span
                            class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">{{ __('Ekspedisi') }}</span>
                        <span class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate">
                            {{ strtoupper($order->shipping->courier ?? 'Reguler') }}
                            @if (!empty($order->shipping->receipt_number))
                                <span class="block text-[8px] text-[#555a42] font-black">Resi:
                                    {{ $order->shipping->receipt_number }}</span>
                                @if ($tracking_url)
                                    <a href="{{ $tracking_url }}" target="_blank" rel="noopener"
                                        class="mt-1 inline-flex items-center gap-1 text-[9px] font-black text-[#555a42] hover:text-black transition">
                                        Lacak Pengiriman &rarr;
                                    </a>
                                @endif
                            @endif
                        </span>
                    </div>
                    <div class="min-w-0">
                        <span class="block font-bold text-[#8c9082] uppercase tracking-wider text-[9px]">{{ __('Alamat') }}</span>
                        <span class="mt-0.5 block font-bold text-[#20221b] text-[10px] sm:text-[11px] truncate"
                            title="{{ $order->address_line }}">
                            {{ $order->customer->full_name }} —
                            {{ $order->destination->city ?? $order->address_line }}
                        </span>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="flex items-center justify-between mb-2.5">
                        <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082]">{{ __('Order Info') }}</h2>
                        <span class="text-xs font-bold text-[#8c9082]">
                            {{ $order->items->count() }} Produk
                        </span>
                    </div>

                    <div class="divide-y divide-[#f0f0eb] rounded-xl border border-[#e8e9e1] bg-white overflow-hidden">
                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-3 p-3 hover:bg-[#f7f7f2]/60 transition">
                                <div
                                    class="size-12 shrink-0 overflow-hidden rounded-lg bg-[#f2f3ed] border border-[#e2e8f0]">
                                    <img src="{{ $item->cover_url }}" alt="{{ $item->name }}"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-bold text-[#20221b] truncate">{{ $item->name }}</h3>
                                    <div class="mt-0.5 flex items-center gap-2">
                                        <span
                                            class="text-[11px] font-bold text-[#555a42]">{{ $item->price_formatted }}</span>
                                        <span
                                            class="inline-flex items-center rounded-md bg-[#f2f3ed] px-1.5 py-0.2 text-[10px] font-bold text-[#555a42]">
                                            Qty: {{ $item->quantity }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-black text-[#20221b]">{{ $item->total_formatted }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-5">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082] mb-2.5">{{ __('Order Summary') }}</h2>
                    <div class="rounded-xl bg-[#f7f7f2] p-4 border border-[#e8e9e1] space-y-2 text-xs">
                        <div class="flex items-center justify-between text-[#555a42] font-medium">
                            <span>{{ __('Subtotal Produk') }}</span>
                            <span class="font-bold text-[#20221b]">{{ $order->sub_total_formatted }}</span>
                        </div>
                        <div class="flex items-center justify-between text-[#555a42] font-medium">
                            <span>{{ __('Ongkos Kirim (Shipping)') }}</span>
                            <span class="font-bold text-[#20221b]">{{ $order->shipping_total_formatted }}</span>
                        </div>
                        <div class="border-t border-[#e6e8de] pt-2 flex items-center justify-between">
                            <span class="text-xs font-black uppercase text-[#20221b]">{{ __('Total Pembayaran') }}</span>
                            <span class="text-base font-black text-[#20221b]">{{ $order->total_formatted }}</span>
                        </div>
                    </div>
                </div>

                @if ($order->status == \App\States\SalesOrder\Pending::class)
                    <div class="mt-5 pt-4 border-t border-[#f0f0eb] no-print">
                        <h2 class="text-[11px] font-black uppercase tracking-[0.14em] text-[#8c9082] mb-3">{{ __('Petunjuk Pembayaran') }}</h2>

                        @php
                            $paymentPayload = $order->payment->payload ?? [];
                        @endphp

                        @if ($order->payment->driver === 'offline' && ! empty($paymentPayload['account_number']))
                            <div class="rounded-xl bg-[#f7f7f2] p-4 border border-[#e8e9e1] mb-4">
                                <p class="text-xs text-[#555a42] mb-3">{{ __('Lakukan transfer sebesar') }}<strong class="text-[#20221b]">{{ $order->total_formatted }}</strong>{{ __('ke rekening berikut, lalu hubungi kami untuk verifikasi:') }}</p>
                                <div class="bg-white border border-[#e2e8f0] rounded-xl divide-y divide-[#f0f0eb]">
                                    <div class="flex items-center justify-between px-4 py-3">
                                        <span class="text-[10px] font-bold text-[#8c9082] uppercase">{{ __('Bank') }}</span>
                                        <span
                                            class="text-xs font-black text-[#20221b]">{{ strtoupper($order->payment->label) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between px-4 py-3">
                                        <span class="text-[10px] font-bold text-[#8c9082] uppercase">{{ __('No. Rekening') }}</span>
                                        <span
                                            class="text-xs font-black text-[#20221b] font-mono">{{ $paymentPayload['account_number'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between px-4 py-3">
                                        <span class="text-[10px] font-bold text-[#8c9082] uppercase">{{ __('a.n.') }}</span>
                                        <span
                                            class="text-xs font-black text-[#20221b]">{{ $paymentPayload['account_holder_name'] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($order->payment->driver === 'offline')
                            <div class="rounded-xl bg-white border border-dashed border-[#d8dac9] p-4 mb-4">
                                <h3 class="text-xs font-black text-[#20221b] mb-1">{{ __('Upload Bukti Transfer') }}</h3>
                                <p class="text-[11px] text-[#8c9082] mb-3">
                                    Sudah transfer? Unggah bukti pembayaran (JPG/PNG/WebP, maks. 5MB) agar pesanan
                                    segera diverifikasi dan diproses.
                                </p>

                                @if ($proofUrl)
                                    <div class="mb-3">
                                        <img src="{{ $proofUrl }}" alt="Bukti transfer"
                                            class="max-h-40 rounded-lg border border-[#e2e8f0] bg-white object-contain">
                                    </div>
                                @endif

                                <form wire:submit="uploadProof"
                                    class="flex flex-col sm:flex-row gap-2.5 items-start">
                                    <input type="file" wire:model="proof"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="block w-full text-[11px] text-[#555a42] file:mr-3 file:rounded-lg file:border-0 file:bg-[#f2f3ed] file:px-3 file:py-1.5 file:text-[11px] file:font-bold file:text-[#555a42] hover:file:bg-[#e6e8de] transition cursor-pointer">
                                    @error('proof')
                                        <p class="text-[11px] font-semibold text-rose-600">{{ $message }}</p>
                                    @enderror
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-[#20221b] px-5 py-2 text-[11px] font-bold text-white hover:bg-black disabled:opacity-60 transition">
                                        <span wire:loading.remove wire:target="proof">{{ __('Upload Bukti') }}</span>
                                        <span wire:loading wire:target="proof">{{ __('Mengunggah...') }}</span>
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div
                            class="flex flex-col sm:flex-row items-center justify-between gap-3 rounded-xl bg-[#f7f7f2] border border-[#e8e9e1] p-4">
                            <div class="text-xs text-[#8c9082]">
                                <p class="font-bold text-[#20221b]">{{ __('Menunggu Pembayaran') }}</p>
                                <p class="text-[11px]">Selesaikan sebelum batas waktu:
                                    {{ $order->due_date_at_formatted }}.</p>
                            </div>
                            @if ($is_redirect)
                                <a href="{{ $redirect_url }}"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 rounded-xl bg-[#20221b] px-6 py-2.5 text-xs font-bold text-white shadow-xs hover:bg-black transition">
                                    Bayar Sekarang &rarr;
                                </a>
                            @else
                                <span
                                    class="text-xs font-bold text-amber-800 bg-amber-50 px-3.5 py-1.5 rounded-xl border border-amber-200">
                                    Silakan Hubungi CS WhatsApp: {{ config('services.contact.whatsapp') }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3 rounded-xl bg-white border border-rose-100 p-4">
                            <div class="text-xs text-[#8c9082]">
                                <p class="font-bold text-rose-700">{{ __('Pembatalan') }}</p>
                                <p class="text-[11px]">{{ __('Belum membayar? Batalkan pesanan dan stok akan otomatis dikembalikan.') }}</p>
                            </div>
                            <button type="button" wire:click="cancelOrder"
                                wire:confirm="Yakin ingin membatalkan pesanan ini?"
                                wire:loading.attr="disabled"
                                class="shrink-0 inline-flex items-center justify-center gap-1.5 rounded-xl border border-rose-200 bg-rose-50 px-5 py-2.5 text-xs font-bold text-rose-700 hover:bg-rose-100 transition disabled:opacity-60">{{ __('Batalkan Pesanan') }}</button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </x-layouts.app>
</div>
