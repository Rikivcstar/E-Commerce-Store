<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\SalesOrderService;
use App\Services\UserCartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CustomerRegister extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        if (Auth::check()) {
            redirect()->route('account.dashboard');
        }
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password confirmation',
        ];
    }

    protected function messages(): array
    {
        return [
            'email.unique' => 'Email ini sudah terdaftar. Silakan login.',
        ];
    }

    public function register(): void
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user, remember: true);
        session()->regenerate();

        $linked = app(SalesOrderService::class)->linkGuestOrders($user);

        $mergedCart = app(UserCartService::class)->mergeFromSession($user->id);

        $messages = [];

        if ($linked > 0) {
            $messages[] = "{$linked} pesanan checkout-tamu tersimpan ke akun Anda";
        }

        if ($mergedCart > 0) {
            $messages[] = "{$mergedCart} item keranjang turut digabungkan";
        }

        toast(
            count($messages) > 0
                ? 'Pendaftaran berhasil! '.implode(', dan ', $messages).'.'
                : 'Pendaftaran akun berhasil! Selamat bergabung.',
            'success'
        );

        $this->redirect(route('account.dashboard'), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.customer-register')
            ->layout('components.layouts.app');
    }
}
