<?php

namespace Tests\Feature;

use App\Jobs\MootaPaymentJob;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\WebhookClient\Models\WebhookCall;
use Tests\Concerns\CreatesAdminRoles;
use Tests\TestCase;

class MootaPaymentJobTest extends TestCase
{
    use CreatesAdminRoles, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createAdminRoles();
    }

    private function createPendingOrder(User $user, string $trxId = 'TRX-MOOTA-001', float $total = 100_000): SalesOrder
    {
        $product = Product::create([
            'name' => 'Tas',
            'sku' => 'SKU-MOOTA-001',
            'slug' => 'tas-moota',
            'description' => 'Tas',
            'stock' => 5,
            'price' => $total - 20_000,
            'weight' => 1000,
        ]);

        $order = SalesOrder::create([
            'trx_id' => $trxId,
            'user_id' => $user->id,
            'status' => \App\States\SalesOrder\Pending::class,
            'customer_full_name' => 'Budi Test',
            'customer_email' => $user->email,
            'customer_phone' => '081234567890',
            'address_line' => 'Jl. Test No. 1',
            'origin_code' => 'SUB1',
            'origin_province' => 'Jawa Barat',
            'origin_city' => 'Bandung',
            'origin_district' => 'Coblong',
            'origin_sub_district' => 'Dago',
            'origin_postal_code' => '40135',
            'destination_code' => 'SUB1',
            'destination_province' => 'Jawa Barat',
            'destination_city' => 'Bandung',
            'destination_district' => 'Coblong',
            'destination_sub_district' => 'Dago',
            'destination_postal_code' => '40135',
            'shipping_driver' => 'rajaongkir',
            'shipping_receipt_number' => null,
            'shipping_courier' => 'jne',
            'shipping_service' => 'OKE',
            'shipping_estimated_delivery' => '2-3 hari',
            'shipping_cost' => 20_000,
            'shipping_weight' => 1000,
            'payment_driver' => 'moota',
            'payment_method' => 'qris',
            'payment_label' => 'QRIS',
            'payment_payload' => [],
            'sub_total' => $total - 20_000,
            'shipping_total' => 20_000,
            'total' => $total,
            'due_date_at' => now()->addHours(24),
        ]);

        $order->items()->create([
            'name' => $product->name,
            'short_desc' => '-',
            'sku' => $product->sku,
            'slug' => $product->slug,
            'description' => $product->description,
            'cover_url' => '',
            'quantity' => 1,
            'price' => $total - 20_000,
            'total' => $total - 20_000,
            'weight' => $product->weight,
        ]);

        return $order;
    }

    private function runJob(array $payload): void
    {
        $webhookCall = WebhookCall::create([
            'name' => 'default',
            'url' => 'https://webstore.test/moota/callback',
            'headers' => ['Signature' => 'test'],
            'payload' => $payload,
        ]);

        (new MootaPaymentJob($webhookCall))->handle();
    }

    public function test_success_status_approves_order(): void
    {
        $user = User::factory()->create();
        $order = $this->createPendingOrder($user, 'TRX-MOOTA-001');

        $this->runJob([
            [
                'payment_detail' => [
                    'trx_id' => 'TRX-MOOTA-001',
                    'status' => 'success',
                    'amount_captured' => 100_000,
                ],
            ],
        ]);

        $this->assertSame(\App\States\SalesOrder\Progress::class, (string) $order->fresh()->status);
    }

    public function test_non_success_status_is_ignored(): void
    {
        $user = User::factory()->create();
        $order = $this->createPendingOrder($user, 'TRX-MOOTA-002');

        $this->runJob([
            [
                'payment_detail' => [
                    'trx_id' => 'TRX-MOOTA-002',
                    'status' => 'pending',
                    'amount_captured' => 100_000,
                ],
            ],
        ]);

        // Status tidak berubah → tetap menunggu pembayaran.
        $this->assertSame(\App\States\SalesOrder\Pending::class, (string) $order->fresh()->status);
    }

    public function test_payload_without_trx_id_is_skipped(): void
    {
        $user = User::factory()->create();
        $this->createPendingOrder($user, 'TRX-MOOTA-003');

        $this->runJob([
            [
                'payment_detail' => [
                    'status' => 'success',
                    'amount_captured' => 100_000,
                ],
            ],
        ]);

        $this->assertSame(\App\States\SalesOrder\Pending::class, (string) SalesOrder::first()->fresh()->status);
    }

    public function test_underpayment_is_rejected(): void
    {
        $user = User::factory()->create();
        $order = $this->createPendingOrder($user, 'TRX-MOOTA-004', total: 100_000);

        $this->runJob([
            [
                'payment_detail' => [
                    'trx_id' => 'TRX-MOOTA-004',
                    'status' => 'success',
                    'amount_captured' => 50_000,
                ],
            ],
        ]);

        $this->assertSame(\App\States\SalesOrder\Pending::class, (string) $order->fresh()->status);
    }
}
