<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YipCommerceFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_user_can_view_products(): void
    {
        Product::query()->create([
            'name' => 'Test Backpack',
            'slug' => 'test-backpack',
            'description' => 'A durable product for testing.',
            'price' => 25000,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->get('/products')
            ->assertOk()
            ->assertSee('Test Backpack');
    }

    public function test_user_can_add_product_to_cart(): void
    {
        $product = Product::query()->create([
            'name' => 'Cart Product',
            'slug' => 'cart-product',
            'description' => 'A product that can be added to cart.',
            'price' => 12500,
            'stock' => 3,
            'status' => 'active',
        ]);

        $this->post(route('cart.add', $product), ['quantity' => 2])
            ->assertRedirect();

        $this->assertSame(2, session('cart.items')[$product->id]['quantity']);
    }

    public function test_authenticated_user_can_checkout(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $product = Product::query()->create([
            'name' => 'Checkout Product',
            'slug' => 'checkout-product',
            'description' => 'A product that can be checked out.',
            'price' => 15000,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->withSession(['cart.items' => [$product->id => ['quantity' => 2]]])
            ->post(route('checkout.store'), [
                'full_name' => 'Demo Customer',
                'email' => 'customer@example.com',
                'phone' => '+2348012345678',
                'delivery_address' => '12 Sample Street',
                'city' => 'Lagos',
                'payment_method' => 'Cash on Delivery',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 30000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
            'total' => 30000,
        ]);

        $this->assertSame(3, $product->fresh()->stock);
        $this->assertNull(session('cart.items'));
    }

    public function test_admin_can_view_orders(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'user']);

        $order = Order::query()->create([
            'user_id' => $customer->id,
            'order_number' => 'YIP-TEST-00001',
            'full_name' => 'Demo Customer',
            'email' => 'customer@example.com',
            'phone' => '+2348012345678',
            'delivery_address' => '12 Sample Street',
            'city' => 'Lagos',
            'payment_method' => 'Bank Transfer',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'subtotal' => 10000,
            'total' => 10000,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.orders.show', $order))
            ->assertOk()
            ->assertSee('YIP-TEST-00001');
    }

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }
}
