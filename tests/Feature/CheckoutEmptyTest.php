<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CheckoutEmptyTest extends TestCase
{
    public function test_posting_an_empty_cart_does_not_create_an_order(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['cart' => []])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'shipping_address' => 'Jl. Mawar 1',
            ])
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertSame(0, Order::count());
    }

    public function test_the_checkout_summary_redirects_an_empty_cart_to_the_cart(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['cart' => []])
            ->get('/checkout')
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('error');
    }

    public function test_a_cart_line_whose_product_is_deleted_is_ignored(): void
    {
        // The product can vanish between adding it and checking out; the line
        // must be dropped, not crash the summary or the order.
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 5]);
        $id = $product->id;
        $product->delete();

        $this->actingAs($user)
            ->withSession(['cart' => [$id => 1]])
            ->get('/checkout')
            ->assertRedirect(route('cart.index'));
    }

    public function test_checkout_clears_the_cart_on_success(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 5, 'price' => 1000]);

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 1]])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'shipping_address' => 'Jl. Mawar 1',
            ]);

        $this->assertNull(session('cart'));
    }
}
