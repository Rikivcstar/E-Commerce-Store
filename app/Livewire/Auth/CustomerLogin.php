<?php

namespace App\Livewire\Auth;

use App\Services\SalesOrderService;
use App\Services\UserCartService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerLogin extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function mount(): void
    {
        if (Auth::check()) {
            redirect()->route('account.dashboard');
        }
    }

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function login(): void
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            $linked = app(SalesOrderService::class)->linkGuestOrders(Auth::user());

            $mergedCart = app(UserCartService::class)->mergeFromSession(Auth::id());

            $messages = [];

            if ($linked > 0) {
                $messages[] = "{$linked} pesanan checkout-tamu tersimpan ke akun Anda";
            }

            if ($mergedCart > 0) {
                $messages[] = "{$mergedCart} item keranjang turut digabungkan";
            }

            toast(
                count($messages) > 0
                    ? 'Berhasil Sign In! '.implode(', dan ', $messages).'.'
                    : 'Berhasil Sign In!',
                'success'
            );

            $this->redirect(route('account.dashboard'), navigate: false);

            return;
        }

        \RealRashid\SweetAlert\Facades\Alert::error('Gagal Login', 'Email atau password yang Anda masukkan salah.');
        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.customer-login')
            ->layout('components.layouts.app');
    }
}
