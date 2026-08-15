<?php

namespace Tests\Feature;

use App\Data\CartData;
use App\Data\CartItemData;
use App\Data\CheckoutData;
use App\Data\CustomerData;
use App\Data\PaymentData;
use App\Data\RegionData;
use App\Data\ShippingData;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\User;
use App\Services\CheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\LaravelData\DataCollection;
use Tests\Concerns\CreatesAdminRoles;
use Tests\TestCase;

class CheckoutServiceTest extends TestCase
{
    use CreatesAdminRoles, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createAdminRoles();
    }

    private function regionData(): RegionData
    {
        return new RegionData(
            code: 'SUB1',
            province: 'Jawa Barat',
            city: 'Bandung',
            district: 'Coblong',
            sub_district: 'Dago',
            postal_code: '40135',
        );
    }

    private function checkoutData(User $user, array $items, ?string $couponCode = null, float $discountTotal = 0): CheckoutData
    {
        return new CheckoutData(
            customer: new CustomerData('Budi Test', $user->email, '081234567890'),
            address_line: 'Jl. Test No. 1',
            origin: $this->regionData(),
            destination: $this->regionData(),
            cart: new CartData(new DataCollection(CartItemData::class, $items)),
            shipping: new ShippingData(
                driver: 'rajaongkir',
                courier: 'jne',
                service: 'OKE',
                estimated_delivery: '2-3 hari',
                cost: 20_000,
                weight: 1,
                origin: $this->regionData(),
                destination: $this->regionData(),
                logo_url: null,
            ),
            payment: new PaymentData(
                driver: 'offline',
                method: 'bca-bank-transfer',
                label: 'Bank Transfer BCA',
                payload: ['account_number' => '31313131'],
            ),
            coupon_code: $couponCode,
            discount_total: $discountTotal,
        );
    }

    public function test_checkout_creates_order_and_decrements_stock(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::create([
            'name' => 'Tas Ransel',
            'sku' => 'SKU-TEST-001',
            'slug' => 'tas-ransel',
            'description' => 'Tas ransel',
            'stock' => 10,
            'price' => 150_000,
            'weight' => 1000,
        ]);

        $checkout = $this->checkoutData($user, [
            ['sku' => 'SKU-TEST-001', 'quantity' => 2, 'price' => 150_000, 'weight' => 1000],
        ]);

        $orderData = app(CheckoutService::class)->makeAndOrder($checkout);

        $this->assertSame('SKU-TEST-001', $orderData->items[0]->sku);

        $this->assertDatabaseHas('sales_orders', [
            'trx_id' => $orderData->trx_id,
            'user_id' => $user->id,
            'status' => \App\States\SalesOrder\Pending::class,
        ]);

        // Stok berkurang
        $this->assertSame(8, $product->fresh()->stock);

        // Subtotal: 2 x 150.000 = 300.000, ongkir 20.000
        $this->assertSame(300_000.0, $orderData->sub_total);
        $this->assertSame(320_000.0, $orderData->total);
    }

    public function test_checkout_revalidates_coupon_against_server_data(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::create([
            'name' => 'Kaos Polos',
            'sku' => 'SKU-TEST-002',
            'slug' => 'kaos-polos',
            'description' => 'Kaos',
            'stock' => 5,
            'price' => 100_000,
            'weight' => 300,
        ]);

        Coupon::create([
            'code' => 'HEMAT10',
            'type' => 'percent',
            'value' => 10,
            'is_active' => true,
        ]);

        // Klien mengirim diskon palsu 200.000 — server harus menghitung ulang.
        $checkout = $this->checkoutData($user, [
            ['sku' => 'SKU-TEST-002', 'quantity' => 1, 'price' => 100_000, 'weight' => 300],
        ], couponCode: 'HEMAT10', discountTotal: 200_000);

        $orderData = app(CheckoutService::class)->makeAndOrder($checkout);

        // Subtotal 100.000 + ongkir 20.000 - diskon 10.000 = 110.000
        $this->assertSame(110_000.0, $orderData->total);
        $this->assertDatabaseHas('sales_orders', [
            'trx_id' => $orderData->trx_id,
            'discount_total' => 10_000,
        ]);
    }

    public function test_checkout_throws_when_stock_insufficient(): void
    {
        $user = User::factory()->create();
        Product::create([
            'name' => 'Sepatu',
            'sku' => 'SKU-TEST-003',
            'slug' => 'sepatu',
            'description' => 'Sepatu',
            'stock' => 1,
            'price' => 200_000,
            'weight' => 800,
        ]);

        $checkout = $this->checkoutData($user, [
            ['sku' => 'SKU-TEST-003', 'quantity' => 3, 'price' => 200_000, 'weight' => 800],
        ]);

        $this->expectException(\RuntimeException::class);

        app(CheckoutService::class)->makeAndOrder($checkout);
    }

    public function test_checkout_rolls_back_when_exception_occurs(): void
    {
        $user = User::factory()->create();
        Product::create([
            'name' => 'Dompet',
            'sku' => 'SKU-TEST-004',
            'slug' => 'dompet',
            'description' => 'Dompet',
            'stock' => 5,
            'price' => 50_000,
            'weight' => 200,
        ]);

        $checkout = $this->checkoutData($user, [
            ['sku' => 'SKU-TEST-004', 'quantity' => 1, 'price' => 50_000, 'weight' => 200],
            ['sku' => 'SKU-TEST-MISSING', 'quantity' => 1, 'price' => 10_000, 'weight' => 100],
        ]);

        try {
            app(CheckoutService::class)->makeAndOrder($checkout);
            $this->fail('Expected RuntimeException was not thrown.');
        } catch (\RuntimeException) {
            // Expected
        }

        // Tidak ada order yang dibuat & stok tidak berubah.
        $this->assertSame(0, SalesOrder::count());
        $this->assertSame(5, Product::where('sku', 'SKU-TEST-004')->value('stock'));
    }
}
