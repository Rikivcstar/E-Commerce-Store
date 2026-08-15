<?php

namespace App\Livewire\Auth;

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
            redirect()->route('account.orders');
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
            toast('Berhasil Sign In!', 'success');
            $this->redirect(route('account.orders'), navigate: false);

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
