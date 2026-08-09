<?php

namespace App\Livewire\Account;

use App\Data\SalesOrderData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderHistory extends Component
{
    public function mount(): void
    {
        if (!Auth::check()) {
            redirect()->route('login');
        }
    }

    public function getOrdersProperty(): Collection
    {
        return Auth::user()
            ->salesOrders
            ->map(fn($order) => SalesOrderData::fromModel($order));
    }

    public function render()
    {
        return view('livewire.account.order-history', [
            'orders' => $this->orders,
        ])->layout('components.layouts.app');
    }
}
