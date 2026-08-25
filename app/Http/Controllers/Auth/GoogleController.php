<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            logger()->error('Google Auth Exception: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Alert::error('Gagal Login Google', 'Autentikasi gagal: '.$e->getMessage());

            return redirect('http://webstore.test/login');
        }

        if (! $googleUser || ! $googleUser->getEmail()) {
            Alert::error('Gagal Login Google', 'Tidak dapat mengambil informasi email dari akun Google.');

            return redirect('http://webstore.test/login');
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (! $user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName() ?: ($googleUser->getNickname() ?: 'User Google'),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(24)),
                ]);
            }
        }

        $authToken = Str::random(40);
        Cache::put('google_auth_token_'.$authToken, $user->id, now()->addMinutes(5));

        return redirect('http://webstore.test/auth/google/token-login/'.$authToken);
    }

    public function tokenLogin(string $token)
    {
        $userId = Cache::pull('google_auth_token_'.$token);

        if (! $userId) {
            Alert::error('Autentikasi Gagal', 'Sesi login Google telah kadaluarsa atau tidak valid. Silakan coba lagi.');

            return redirect('http://webstore.test/login');
        }

        $user = User::findOrFail($userId);

        // Email dari Google sudah terverifikasi, tandai agar tidak terblokir middleware "verified".
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        session()->regenerate();
        Auth::login($user, remember: true);

        toast('Berhasil Sign In dengan Google!', 'success');

        return redirect()->intended('http://webstore.test/account/orders');
    }
}
