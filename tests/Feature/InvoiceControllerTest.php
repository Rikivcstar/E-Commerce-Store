<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createOrder(User $user, string $trxId = 'TRX-INV-001'): SalesOrder
    {
        $product = Product::create([
            'name' => 'Tas',
            'sku' => 'SKU-INV-001',
            'slug' => 'tas-inv',
            'description' => 'Tas',
            'stock' => 5,
            'price' => 80_000,
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
            'payment_driver' => 'offline',
            'payment_method' => 'bca-bank-transfer',
            'payment_label' => 'Bank Transfer BCA',
            'payment_payload' => [],
            'sub_total' => 80_000,
            'shipping_total' => 20_000,
            'total' => 100_000,
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
            'price' => 80_000,
            'total' => 80_000,
            'weight' => $product->weight,
        ]);

        return $order;
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $user = User::factory()->create();
        $order = $this->createOrder($user);

        $this->get(route('admin.sales-orders.invoice', $order))
            ->assertRedirect('/login');
    }

    public function test_user_without_admin_role_gets_403(): void
    {
        $user = User::factory()->create();
        $order = $this->createOrder($user);

        $this->actingAs($user)
            ->get(route('admin.sales-orders.invoice', $order))
            ->assertForbidden();
    }

    public function test_panel_user_can_download_invoice(): void
    {
        Role::findOrCreate('panel_user', 'web');

        $owner = User::factory()->create();
        $admin = User::factory()->create()->assignRole('panel_user');
        $order = $this->createOrder($owner);

        $this->actingAs($admin)
            ->get(route('admin.sales-orders.invoice', $order))
            ->assertOk();
    }
}
