<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartSummaryTest extends TestCase
{
    public function test_cart_page_skips_a_product_deactivated_after_it_was_added(): void
    {
        // Checkout, the navbar badge and Product::cartCount all skip a line whose
        // product is inactive; the cart page did not, so it showed a total the
        // checkout summary would then drop.
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 1000, 'stock' => 5]);
        $product->update(['is_active' => false]);

        $response = $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->get('/cart');

        $response->assertOk();
        $response->assertDontSee($product->name);
    }

    public function test_cart_page_lists_a_live_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 1000, 'stock' => 5]);

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->get('/cart')
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('2.000'); // 2 * 1000
    }
}
