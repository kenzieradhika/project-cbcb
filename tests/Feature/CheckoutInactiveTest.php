<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CheckoutInactiveTest extends TestCase
{
    public function test_an_order_rejects_a_product_deactivated_after_it_was_added(): void
    {
        // cart.add guards is_active, but a product already in the cart when an
        // admin deactivates it still passed checkout -- it was hidden from the
        // storefront yet still orderable.
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Kaos',
            'slug' => 'kaos-'.uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'is_active' => true,
        ]);
        $product->update(['is_active' => false]);

        $response = $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 1]])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'shipping_address' => 'Jl. Mawar 1',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertSame(0, Order::count());
        $this->assertSame(5, $product->fresh()->stock);
    }
}
