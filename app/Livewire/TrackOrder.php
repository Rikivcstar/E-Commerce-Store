<?php

namespace App\Livewire;

use App\Models\SalesOrder;
use Livewire\Component;

class TrackOrder extends Component
{
    public string $trx_id = '';

    public string $phone = '';

    protected function rules(): array
    {
        return [
            'trx_id' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:13', 'min:7'],
        ];
    }

    public function track(): void
    {
        $this->validate();

        // Tracking publik hanya untuk pesanan tamu (user_id null).
        // Pesanan milik akun sudah bisa dilihat di My Orders (account).
        $order = SalesOrder::query()
            ->where('trx_id', strtoupper(trim($this->trx_id)))
            ->where('customer_phone', trim($this->phone))
            ->whereNull('user_id')
            ->first();

        if (! $order) {
            $this->addError('trx_id', 'Pesanan tidak ditemukan. Periksa kembali No. Transaksi dan No. HP Anda.');
            toast('Pesanan tidak ditemukan.', 'error');

            return;
        }

        toast('Pesanan ditemukan!', 'success');

        $this->redirectRoute('order-confirmed', $order->trx_id, navigate: true);
    }

    public function render()
    {
        return view('livewire.track-order');
    }
}