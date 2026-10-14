<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CheckoutStockTest extends TestCase
{
    private function product(int $stock): Product
    {
        return Product::create([
            'name' => 'Kaos',
            'slug' => 'kaos-' . uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => $stock,
            'is_active' => true,
        ]);
    }

    public function test_insufficient_stock_redirects_back_instead_of_500(): void
    {
        // Stock can drop between adding to the cart and checking out (another
        // buyer, an admin edit). The raw \Exception thrown inside the
        // transaction surfaced as a 500 page and lost the cart message.
        $user = User::factory()->create();
        $product = $this->product(1);

        $response = $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 5]])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'shipping_address' => 'Jl. Mawar 1',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertSame(0, Order::count());
        $this->assertSame(1, $product->fresh()->stock);
    }
}
