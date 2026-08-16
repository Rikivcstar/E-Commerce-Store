<?php

namespace App\Livewire\Account;

use App\Data\SalesOrderData;
use App\States\SalesOrder\Cancel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount(): void
    {
        if (! Auth::check()) {
            redirect()->route('login');
        }
    }

    public function getStatsProperty(): array
    {
        $user = Auth::user();
        $total_spent = (float) $user->salesOrders()->where('status', '!=', Cancel::class)->sum('total');

        return [
            'total_orders' => $user->salesOrders()->count(),
            'active_orders' => $user->salesOrders()->where('status', '!=', Cancel::class)->count(),
            'total_spent_formatted' => Number::currency($total_spent),
            'wishlist_count' => $user->wishlistProducts()->count(),
            'address_count' => $user->addresses()->count(),
        ];
    }

    public function getLatestOrderProperty(): ?SalesOrderData
    {
        $order = Auth::user()->salesOrders()->latest()->first();

        return $order ? SalesOrderData::fromModel($order) : null;
    }

    public function render()
    {
        return view('livewire.account.dashboard', [
            'stats' => $this->stats,
            'latest_order' => $this->latest_order,
        ])->layout('components.layouts.app');
    }
}