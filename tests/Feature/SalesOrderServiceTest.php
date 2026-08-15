<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\User;
use App\Services\SalesOrderService;
use App\States\SalesOrder\Progress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\Concerns\CreatesAdminRoles;
use Tests\TestCase;

class SalesOrderServiceTest extends TestCase
{
    use CreatesAdminRoles, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createAdminRoles();
    }

    private function createPendingOrder(User $user, Product $product, float $total = 100_000, string $trxId = 'TRX-TEST-001'): SalesOrder
    {
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
            'payment_driver' => 'offline',
            'payment_method' => 'bca-bank-transfer',
            'payment_label' => 'Bank Transfer BCA',
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

    public function test_approve_payment_transitions_pending_to_progress(): void
    {
        Log::spy();

        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Tas Ransel',
            'sku' => 'SKU-APPROVE-001',
            'slug' => 'tas-ransel-approve',
            'description' => 'Tas',
            'stock' => 5,
            'price' => 80_000,
            'weight' => 1000,
        ]);

        $order = $this->createPendingOrder($user, $product, total: 100_000);

        app(SalesOrderService::class)->approvePaymentUsingTrxId($order->trx_id, 100_000);

        $this->assertSame(Progress::class, (string) $order->fresh()->status);
        $this->assertNotNull($order->fresh()->payment_paid_at);
    }

    public function test_approve_payment_ignores_already_processed_order(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Dompet',
            'sku' => 'SKU-APPROVE-002',
            'slug' => 'dompet-approve',
            'description' => 'Dompet',
            'stock' => 5,
            'price' => 30_000,
            'weight' => 200,
        ]);

        $order = $this->createPendingOrder($user, $product, total: 50_000);
        $order->update(['status' => Progress::class]);

        app(SalesOrderService::class)->approvePaymentUsingTrxId($order->trx_id, 50_000);

        // Status tetap Progress (bukan menjadi double-process).
        $this->assertSame(Progress::class, (string) $order->fresh()->status);
    }

    public function test_approve_payment_rejects_underpayment(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Kaos',
            'sku' => 'SKU-APPROVE-003',
            'slug' => 'kaos-approve',
            'description' => 'Kaos',
            'stock' => 5,
            'price' => 80_000,
            'weight' => 300,
        ]);

        $order = $this->createPendingOrder($user, $product, total: 100_000);

        app(SalesOrderService::class)->approvePaymentUsingTrxId($order->trx_id, 50_000);

        // Pembayaran kurang dari total → tetap pending.
        $this->assertSame(\App\States\SalesOrder\Pending::class, (string) $order->fresh()->status);
    }

    public function test_return_stock_increments_product_stock(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Sepatu',
            'sku' => 'SKU-RETURN-001',
            'slug' => 'sepatu-return',
            'description' => 'Sepatu',
            'stock' => 3,
            'price' => 200_000,
            'weight' => 800,
        ]);

        $order = $this->createPendingOrder($user, $product, total: 220_000);

        $service = app(SalesOrderService::class);
        $data = \App\Data\SalesOrderData::fromModel($order);

        $service->returnStock($data);

        $this->assertSame(4, $product->fresh()->stock);
    }
}
