<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CheckoutSummaryTest extends TestCase
{
    public function test_checkout_redirects_when_a_line_exceeds_stock(): void
    {
        // Stock dropped after the item was added. The summary used the stored
        // quantity, showing a total that store() would then refuse, so send the
        // shopper back to the cart with an explanation.
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 2, 'price' => 1000]);

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 5]])
            ->get('/checkout')
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('error');
    }

    public function test_checkout_summary_uses_the_cart_quantity_when_in_stock(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 5, 'price' => 1000]);

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->get('/checkout')
            ->assertOk()
            ->assertSee('2.000'); // 2 * 1000, number_format with '.' thousands
    }
}
