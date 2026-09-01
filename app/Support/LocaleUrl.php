<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;

class LocaleUrl
{
    /**
     * Bangun URL saat ini dengan query param "lang" diganti ke locale tertentu,
     * sambil mempertahankan query param lain yang sedang aktif.
     */
    public static function for(string $locale): string
    {
        $query = request()->query();
        $query['lang'] = $locale;

        return URL::current().'?'.http_build_query($query);
    }
}
