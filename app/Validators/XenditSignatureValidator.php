<?php

declare(strict_types=1);

namespace App\Validators;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class XenditSignatureValidator implements SignatureValidator
{
    /**
     * Verifikasi keaslian callback dari Xendit menggunakan header x-callback-token.
     * Token tersedia di Xendit Dashboard → Settings → Developers → Callback Token.
     */
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $callbackToken = $request->header('x-callback-token');

        if (! $callbackToken) {
            return false;
        }

        return hash_equals((string) config('services.xendit.webhook_token'), $callbackToken);
    }
}
