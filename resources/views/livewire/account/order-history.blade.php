<div>
    <style>
        .oh-shell {
            max-width: 56rem;
            margin: 0 auto;
            padding: 2.5rem clamp(1rem, 4vw, 2.5rem) 5rem;
        }
        .oh-eyebrow {
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #8a8470;
            margin-bottom: 0.5rem;
        }
        .oh-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            text-transform: uppercase;
            color: #111111;
            line-height: 0.88;
            margin-bottom: 2.5rem;
        }
        .oh-user-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: #f0ede6;
            border: 1px solid #d4cec4;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .oh-user-name {
            font-weight: 800;
            font-size: 0.875rem;
            color: #111111;
        }
        .oh-user-email {
            font-size: 0.78rem;
            color: #777777;
        }
        .oh-logout-btn {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #555555;
            background: none;
            border: 1px solid #d4cec4;
            padding: 0.45rem 1rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .oh-logout-btn:hover {
            background: #111111;
            color: #fff;
            border-color: #111111;
        }
        /* Order card */
        .oh-card {
            border: 1px solid #d4cec4;
            background: #fff;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s;
        }
        .oh-card:hover {
            box-shadow: 0 4px 18px rgba(40,35,25,0.08);
        }
        .oh-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #ede9e1;
            flex-wrap: wrap;
        }
        .oh-trx {
            font-size: 0.8rem;
            font-weight: 900;
            letter-spacing: 0.05em;
            color: #111111;
        }
        .oh-date {
            font-size: 0.72rem;
            color: #999;
            font-weight: 600;
        }
        .oh-status {
            font-size: 0.68rem;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            border: 1px solid currentColor;
        }
        .oh-status.pending { color: #b45309; background: #fffbeb; }
        .oh-status.paid    { color: #15803d; background: #f0fdf4; }
        .oh-status.shipped { color: #1d4ed8; background: #eff6ff; }
        .oh-status.done    { color: #374151; background: #f9fafb; }
        .oh-status.cancelled { color: #dc2626; background: #fef2f2; }
        .oh-card-body {
            padding: 1rem 1.25rem;
        }
        .oh-items-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1rem;
        }
        .oh-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f0ede6;
            font-size: 0.8rem;
        }
        .oh-item:last-child { border-bottom: none; }
        .oh-item-img {
            width: 2.8rem;
            height: 2.8rem;
            object-fit: cover;
            background: #e9e6dc;
            flex-shrink: 0;
        }
        .oh-item-name {
            font-weight: 700;
            color: #111111;
            flex: 1;
        }
        .oh-item-qty {
            color: #888;
            font-size: 0.72rem;
        }
        .oh-item-price {
            font-weight: 800;
            color: #111111;
            white-space: nowrap;
        }
        .oh-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.9rem 1.25rem;
            background: #f7f4ee;
            border-top: 1px solid #ede9e1;
            flex-wrap: wrap;
        }
        .oh-total-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #888;
        }
        .oh-total-amount {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.15rem;
            font-weight: 900;
            color: #111111;
        }
        .oh-view-btn {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #111111;
            background: none;
            border: 1px solid #111111;
            padding: 0.45rem 1rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .oh-view-btn:hover {
            background: #111111;
            color: #fff;
        }
        /* Empty state */
        .oh-empty {
            text-align: center;
            padding: 4rem 1rem;
            border: 1px dashed #d4cec4;
        }
        .oh-empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.4;
        }
        .oh-empty-title {
            font-family: 'Syne', 'Finlandica', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            color: #111111;
            margin-bottom: 0.5rem;
        }
        .oh-empty-desc {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 1.5rem;
        }
        .oh-shop-btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: #111111;
            color: #fff;
            font-weight: 800;
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s;
        }
        .oh-shop-btn:hover { background: #000; }
    </style>

    <div class="oh-shell">
        <p class="oh-eyebrow">My Account</p>
        <h1 class="oh-title">Order<br>History</h1>

        {{-- User bar --}}
        <div class="oh-user-bar">
            <div>
                <div class="oh-user-name">{{ auth()->user()->name }}</div>
                <div class="oh-user-email">{{ auth()->user()->email }}</div>
            </div>
            <form id="account-logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" onclick="confirmLogout('account-logout-form')" class="oh-logout-btn">Sign Out</button>
            </form>
        </div>

        {{-- Filter status --}}
        <div class="flex flex-wrap gap-2 mb-4">
            @php
                $filters = ['all' => 'Semua', 'pending' => 'Menunggu', 'progress' => 'Proses', 'completed' => 'Selesai', 'cancel' => 'Batal'];
            @endphp
            @foreach ($filters as $key => $label)
                <button type="button" wire:click="filter('{{ $key }}')"
                    class="text-[0.68rem] font-black uppercase tracking-wider px-3 py-1.5 border transition cursor-pointer {{ $statusFilter === $key ? 'bg-[#111111] text-white border-[#111111]' : 'bg-white text-[#555555] border-[#d4cec4] hover:bg-[#f0ede6]' }}">
                    {{ $label }}
                </button>
            @endforeach

            @if ($orders->count() > 0)
                <span class="ml-auto self-center text-[0.7rem] font-bold text-[#888]">
                    {{ $orders->total() }} order
                </span>
            @endif
        </div>

        {{-- Orders --}}
        @forelse ($orders as $order)
            @php
                $statusClass = match(true) {
                    str_contains(strtolower($order->status_label ?? ''), 'paid')      => 'paid',
                    str_contains(strtolower($order->status_label ?? ''), 'ship')      => 'shipped',
                    str_contains(strtolower($order->status_label ?? ''), 'proses')    => 'shipped',
                    str_contains(strtolower($order->status_label ?? ''), 'done')      => 'done',
                    str_contains(strtolower($order->status_label ?? ''), 'batal')     => 'cancelled',
                    str_contains(strtolower($order->status_label ?? ''), 'cancel')    => 'cancelled',
                    default => 'pending',
                };
            @endphp

            <div class="oh-card">
                <div class="oh-card-header">
                    <div>
                        <div class="oh-trx">{{ $order->trx_id }}</div>
                        <div class="oh-date">{{ $order->created_at_formatted }}</div>
                    </div>
                    <span class="oh-status {{ $statusClass }}">{{ $order->status_label }}</span>
                </div>

                <div class="oh-card-body">
                    <ul class="oh-items-list">
                        @foreach ($order->items as $item)
                            <li class="oh-item">
                                @if ($item->cover_url)
                                    <img src="{{ $item->cover_url }}" alt="{{ $item->name }}" class="oh-item-img">
                                @endif
                                <span class="oh-item-name">{{ $item->name }}</span>
                                <span class="oh-item-qty">× {{ $item->quantity }}</span>
                                <span class="oh-item-price">{{ $item->total_formatted }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="oh-card-footer">
                    <div>
                        <div class="oh-total-label">Total paid</div>
                        <div class="oh-total-amount">{{ $order->total_formatted }}</div>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        @if ($statusClass === 'pending')
                            <button type="button" wire:click="cancelOrder('{{ $order->trx_id }}')"
                                wire:confirm="Yakin ingin membatalkan pesanan {{ $order->trx_id }}? Stok akan dikembalikan."
                                wire:loading.attr="disabled"
                                class="oh-view-btn !text-[#dc2626] !border-[#dc2626] hover:!bg-[#dc2626]">
                                Batal
                            </button>
                        @endif
                        <button type="button" wire:click="buyAgain('{{ $order->trx_id }}')"
                            wire:loading.attr="disabled" class="oh-view-btn">
                            <span wire:loading.remove wire:target="buyAgain('{{ $order->trx_id }}')">Beli Lagi</span>
                            <span wire:loading wire:target="buyAgain('{{ $order->trx_id }}')">Menambahkan...</span>
                        </button>
                        <a href="{{ route('order-confirmed', $order->trx_id) }}" class="oh-view-btn">
                            View Order →
                        </a>
                        <a href="{{ route('account.orders.invoice', $order->trx_id) }}" class="oh-view-btn">
                            Invoice
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="oh-empty">
                <div class="oh-empty-icon">🛍️</div>
                <div class="oh-empty-title">No orders yet</div>
                <p class="oh-empty-desc">Your order history will appear here after you make a purchase.</p>
                <a href="{{ route('product-catalog') }}" class="oh-shop-btn">Start Shopping</a>
            </div>
        @endforelse

        @if ($orders->hasPages())
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>