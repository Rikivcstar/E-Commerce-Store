<?php

namespace App\Livewire\Account;

use App\Contract\CartServiceInterface;
use App\Data\CartItemData;
use App\Data\SalesOrderData;
use App\Models\Product;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public string $statusFilter = 'all';

    protected array $statusMap = [
        'all' => null,
        'pending' => Pending::class,
        'progress' => Progress::class,
        'completed' => Completed::class,
        'cancel' => Cancel::class,
    ];

    public function mount(): void
    {
        if (! Auth::check()) {
            redirect()->route('login');
        }
    }

    public function filter(string $status): void
    {
        $this->statusFilter = in_array($status, array_keys($this->statusMap), true) ? $status : 'all';
        $this->resetPage();
    }

    public function getOrdersProperty(): LengthAwarePaginator
    {
        $query = Auth::user()->salesOrders()->latest();

        if (($this->statusMap[$this->statusFilter] ?? null) !== null) {
            $query->where('status', $this->statusMap[$this->statusFilter]);
        }

        return $query->paginate(5)->through(fn ($order) => SalesOrderData::fromModel($order));
    }

    public function cancelOrder(string $trxId): void
    {
        $order = Auth::user()->salesOrders()->where('trx_id', $trxId)->firstOrFail();

        abort_unless(
            $order->status instanceof Pending,
            403,
            'Pesanan hanya dapat dibatalkan saat masih menunggu pembayaran.'
        );

        $order->status->transitionTo(Cancel::class);

        toast('Pesanan berhasil dibatalkan. Stok produk telah dikembalikan.', 'success');
    }

    public function buyAgain(string $trxId)
    {
        $order = Auth::user()->salesOrders()->where('trx_id', $trxId)->firstOrFail();

        $cart = app(CartServiceInterface::class);
        $added = 0;
        $skipped = 0;

        foreach ($order->items as $item) {
            $product = Product::where('sku', $item->sku)->first();

            if (! $product || $product->stock < 1) {
                $skipped++;

                continue;
            }

            $cart->addOrUpdated(new CartItemData(
                sku: $product->sku,
                quantity: min($item->quantity, $product->stock),
                price: (float) $product->price,
                weight: (int) $product->weight,
            ));

            $added++;
        }

        if ($added === 0) {
            toast('Tidak ada produk yang bisa dibeli ulang (stok sedang habis).', 'error');

            return;
        }

        $this->dispatch('cartUpdated');

        toast(
            $skipped > 0
                ? "{$added} produk ditambahkan ke keranjang, {$skipped} produk di-skip karena stok berubah."
                : "{$added} produk berhasil ditambahkan ke keranjang!",
            'success'
        );

        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.account.order-history', [
            'orders' => $this->orders,
        ])->layout('components.layouts.app');
    }
}