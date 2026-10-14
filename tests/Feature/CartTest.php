<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartTest extends TestCase
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

    public function test_adding_an_out_of_stock_product_is_rejected(): void
    {
        // The add form is disabled at stock 0, but a hand-crafted POST still got
        // through: max(stock, 1) let quantity 1 validate, then the clamp stored
        // quantity 0 -- a phantom cart line that can be checked out as a Rp 0 order.
        $user = User::factory()->create();
        $product = $this->product(0);

        $response = $this->actingAs($user)->post("/cart/{$product->slug}", ['quantity' => 1]);

        $response->assertSessionHas('error');
        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }

    public function test_adding_within_stock_succeeds(): void
    {
        $user = User::factory()->create();
        $product = $this->product(3);

        $this->actingAs($user)->post("/cart/{$product->slug}", ['quantity' => 2]);

        $this->assertSame(2, session('cart')[$product->id]);
    }

    public function test_adding_an_inactive_product_is_rejected(): void
    {
        // The storefront hides inactive products, but cart.add has no is_active
        // check, so a direct POST (or a stale tab) could still order one.
        $user = User::factory()->create();
        $product = $this->product(5);
        $product->update(['is_active' => false]);

        $response = $this->actingAs($user)->post("/cart/{$product->slug}", ['quantity' => 1]);

        $response->assertSessionHas('error');
        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }
}
