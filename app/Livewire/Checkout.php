<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use App\Data\CartData;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Number;
use Livewire\Component;

class Checkout extends Component
{

    public array $data = [
        'full_name' => null,
        'email' => null,
        'phone' => null,
        'address_line' => null,
    ];

    public array $summary = [
        'sub_total' => null,
        'sub_total_formatted' => '-',
        'shipping_total' => null,
        'shipping_total_formatted' => '-',
        'grand_total' => null,
        'grand_total_formatted' => '-',
    ];

    public function rules()
    {
        return [
            'data.full_name' => ['required', 'string', 'max:255',  'min:3'],
            'data.email' => ['required', 'email', 'max:255', 'min:3'],
            'data.phone' => ['required', 'string', 'max:13', 'min:7'],
            'data.address_line' => ['required', 'string', 'max:500'],
        ];
    }



    public function mount()
    {
        if(!Gate::inspect('is_stock_available')->allow()){
            return redirect()->route('cart');
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        data_set($this->summary, 'sub_total', $this->cart->total);
        data_set($this->summary, 'sub_total_formatted', $this->cart->total_formatted);

        $data_shipping = 0;
        data_set($this->summary, 'shipping_total', $data_shipping);
        data_set($this->summary, 'shipping_total_formatted', Number::currency($data_shipping));

        $grand_total = $this->cart->total + $data_shipping;
        data_set($this->summary, 'grand_total', $grand_total);
        data_set($this->summary, 'grand_total_formatted', Number::currency($grand_total));
    }

    public function getCartProperty(CartServiceInterface $cart) : CartData
    {
        return $cart->all();
    }

    public function placeOrder()
    {
        $this->validate();

        dd($this->data);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cart' => $this->cart,
            'summary' => $this->summary
        ]);
    }
}
