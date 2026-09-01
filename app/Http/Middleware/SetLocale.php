<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Menentukan locale aplikasi berdasarkan prioritas:
     * 1. Query param ?lang=
     * 2. Sesi pengguna
     * 3. Cookie
     * 4. Lokale default config (id) — default bahasa Indonesia pada muat pertama.
     * Catatan: Accept-Language browser sengaja TIDAK dipakai agar default selalu bahasa Indonesia.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys(config('app.available_locales', []));

        $locale = null;

        if ($explicit = $request->query('lang')) {
            $locale = $explicit;
        }

        if (! in_array($locale, $available, true)) {
            $locale = $request->session()->get('locale');
        }

        if (! in_array($locale, $available, true)) {
            $locale = $request->cookie('locale');
        }

        if (! in_array($locale, $available, true)) {
            $locale = config('app.locale');
        }

        // Persist pilihan eksplisit (?lang=) di sesi & cookie agar 'nempel' antar halaman.
        if ($explicit && in_array($explicit, $available, true)) {
            $request->session()->put('locale', $explicit);
            Cookie::queue('locale', $explicit, 60 * 24 * 365);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
