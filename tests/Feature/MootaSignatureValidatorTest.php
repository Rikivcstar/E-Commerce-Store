<?php

namespace Tests\Feature;

use App\Validators\MootaSignatureValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;
use Tests\TestCase;

class MootaSignatureValidatorTest extends TestCase
{
    use RefreshDatabase;

    private function makeConfig(string $secret): WebhookConfig
    {
        $base = config('webhook-client.configs.0');

        return new WebhookConfig(array_merge($base, [
            'signing_secret' => $secret,
        ]));
    }

    public function test_valid_signature_passes(): void
    {
        $config = $this->makeConfig('SECRET-KEY-123');
        $request = Request::create('/moota/callback', 'POST');
        $request->headers->set('Signature', 'SECRET-KEY-123');

        $this->assertTrue((new MootaSignatureValidator)->isValid($request, $config));
    }

    public function test_invalid_signature_fails(): void
    {
        $config = $this->makeConfig('SECRET-KEY-123');
        $request = Request::create('/moota/callback', 'POST');
        $request->headers->set('Signature', 'WRONG-SECRET');

        $this->assertFalse((new MootaSignatureValidator)->isValid($request, $config));
    }

    public function test_missing_signature_header_fails(): void
    {
        $config = $this->makeConfig('SECRET-KEY-123');
        $request = Request::create('/moota/callback', 'POST');

        $this->assertFalse((new MootaSignatureValidator)->isValid($request, $config));
    }
}
