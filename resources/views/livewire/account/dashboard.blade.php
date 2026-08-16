<div>
    <x-layouts.app title="Dashboard Akun">
        <style>
            .dash-shell {
                max-width: 56rem;
                margin: 0 auto;
                padding: 2.5rem clamp(1rem, 4vw, 2.5rem) 5rem;
            }
            .dash-eyebrow {
                font-size: 0.7rem;
                font-weight: 900;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: #8a8470;
                margin-bottom: 0.5rem;
            }
            .dash-title {
                font-family: 'Syne', 'Finlandica', sans-serif;
                font-size: clamp(2.5rem, 7vw, 4.5rem);
                font-weight: 900;
                letter-spacing: -0.03em;
                text-transform: uppercase;
                color: #111111;
                line-height: 0.88;
                margin-bottom: 2.5rem;
            }
            .dash-user-bar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 1rem 1.25rem;
                background: #f0ede6;
                border: 1px solid #d4cec4;
                margin-bottom: 1.75rem;
                flex-wrap: wrap;
            }
            .dash-user-name {
                font-weight: 800;
                font-size: 0.875rem;
                color: #111111;
            }
            .dash-user-email {
                font-size: 0.78rem;
                color: #777777;
            }
            .dash-logout-btn {
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
            .dash-logout-btn:hover {
                background: #111111;
                color: #fff;
                border-color: #111111;
            }
            .dash-stats-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.9rem;
                margin-bottom: 1.75rem;
            }
            @media (min-width: 640px) {
                .dash-stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }
            .dash-stat {
                border: 1px solid #d4cec4;
                background: #ffffff;
                padding: 1rem 1.1rem;
            }
            .dash-stat-value {
                font-family: 'Syne', 'Finlandica', sans-serif;
                font-size: 1.4rem;
                font-weight: 900;
                color: #111111;
                line-height: 1.1;
                overflow-wrap: anywhere;
            }
            .dash-stat-label {
                margin-top: 0.3rem;
                font-size: 0.68rem;
                font-weight: 900;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: #8a8470;
            }
            .dash-links {
                display: flex;
                flex-wrap: wrap;
                gap: 0.6rem;
                margin-bottom: 2rem;
            }
            .dash-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.74rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: #111111;
                border: 1px solid #111111;
                padding: 0.6rem 1.1rem;
                text-decoration: none;
                transition: all 0.2s;
            }
            .dash-link:hover {
                background: #111111;
                color: #fff;
            }
            .dash-section-title {
                font-family: 'Syne', 'Finlandica', sans-serif;
                font-size: 1.1rem;
                font-weight: 900;
                text-transform: uppercase;
                color: #111111;
                margin-bottom: 0.9rem;
            }
            .dash-order-card {
                border: 1px solid #d4cec4;
                background: #ffffff;
                margin-bottom: 1rem;
            }
            .dash-order-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 1rem 1.25rem;
                border-bottom: 1px solid #ede9e1;
                flex-wrap: wrap;
            }
            .dash-trx {
                font-size: 0.8rem;
                font-weight: 900;
                letter-spacing: 0.05em;
                color: #111111;
            }
            .dash-date {
                font-size: 0.72rem;
                color: #999;
                font-weight: 600;
            }
            .dash-status {
                font-size: 0.68rem;
                font-weight: 900;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 0.3rem 0.75rem;
                border: 1px solid currentColor;
            }
            .dash-status.pending {
                color: #b45309;
                background: #fffbeb;
            }
            .dash-status.done {
                color: #374151;
                background: #f9fafb;
            }
            .dash-status.cancelled {
                color: #dc2626;
                background: #fef2f2;
            }
            .dash-order-foot {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 0.9rem 1.25rem;
                background: #f7f4ee;
                border-top: 1px solid #ede9e1;
                flex-wrap: wrap;
            }
            .dash-total-label {
                font-size: 0.72rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: #888;
            }
            .dash-total-amount {
                font-family: 'Syne', 'Finlandica', sans-serif;
                font-size: 1.15rem;
                font-weight: 900;
                color: #111111;
            }
            .dash-view-btn {
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
            .dash-view-btn:hover {
                background: #111111;
                color: #fff;
            }
            .dash-empty {
                text-align: center;
                padding: 3rem 1rem;
                border: 1px dashed #d4cec4;
                color: #777777;
                font-size: 0.85rem;
            }
            .dash-empty a {
                display: inline-block;
                margin-top: 1rem;
                padding: 0.65rem 1.5rem;
                background: #111111;
                color: #fff;
                font-size: 0.74rem;
                font-weight: 800;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                text-decoration: none;
            }
            .dash-empty a:hover {
                background: #000;
            }
        </style>

        <div class="dash-shell">
            <p class="dash-eyebrow">My Account</p>
            <h1 class="dash-title">Dashboard</h1>

            <div class="dash-user-bar">
                <div>
                    <div class="dash-user-name">{{ auth()->user()->name }}</div>
                    <div class="dash-user-email">{{ auth()->user()->email }}</div>
                </div>
                <form id="dash-logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout('dash-logout-form')" class="dash-logout-btn">Sign Out</button>
                </form>
            </div>

            <div class="dash-stats-grid">
                <div class="dash-stat">
                    <div class="dash-stat-value">{{ $stats['total_orders'] }}</div>
                    <div class="dash-stat-label">Total Pesanan</div>
                </div>
                <div class="dash-stat">
                    <div class="dash-stat-value">{{ $stats['active_orders'] }}</div>
                    <div class="dash-stat-label">Pesanan Aktif</div>
                </div>
                <div class="dash-stat">
                    <div class="dash-stat-value">{{ $stats['total_spent_formatted'] }}</div>
                    <div class="dash-stat-label">Total Belanja</div>
                </div>
                <div class="dash-stat">
                    <div class="dash-stat-value">{{ $stats['wishlist_count'] }}</div>
                    <div class="dash-stat-label">Wishlist</div>
                </div>
                <div class="dash-stat">
                    <div class="dash-stat-value">{{ $stats['address_count'] }}</div>
                    <div class="dash-stat-label">Alamat Tersimpan</div>
                </div>
            </div>

            <div class="dash-links">
                <a class="dash-link" href="{{ route('account.orders') }}">My Orders</a>
                <a class="dash-link" href="{{ route('account.wishlist') }}">Wishlist</a>
                <a class="dash-link" href="{{ route('account.addresses') }}">Alamat</a>
                <a class="dash-link" href="{{ route('product-catalog') }}">Belanja</a>
            </div>

            <h2 class="dash-section-title">Pesanan Terakhir</h2>

            @if ($latest_order)
                @php
                    $statusClass = match (true) {
                        str_contains(strtolower($latest_order->status_label ?? ''), 'batal') => 'cancelled',
                        str_contains(strtolower($latest_order->status_label ?? ''), 'selesai') => 'done',
                        default => 'pending',
                    };
                @endphp
                <div class="dash-order-card">
                    <div class="dash-order-head">
                        <div>
                            <div class="dash-trx">{{ $latest_order->trx_id }}</div>
                            <div class="dash-date">{{ $latest_order->created_at_formatted }}</div>
                        </div>
                        <span class="dash-status {{ $statusClass }}">{{ $latest_order->status_label }}</span>
                    </div>
                    <div class="dash-order-foot">
                        <div>
                            <div class="dash-total-label">Total Pembayaran</div>
                            <div class="dash-total-amount">{{ $latest_order->total_formatted }}</div>
                        </div>
                        <a href="{{ route('order-confirmed', $latest_order->trx_id) }}" class="dash-view-btn">View Order
                            →</a>
                    </div>
                </div>
            @else
                <div class="dash-empty">
                    <p>Belum ada pesanan.</p>
                    <a href="{{ route('product-catalog') }}">Mulai Belanja</a>
                </div>
            @endif
        </div>
    </x-layouts.app>
</div>