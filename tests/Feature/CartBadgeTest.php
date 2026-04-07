<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartBadgeTest extends TestCase
{
    public function test_badge_ignores_a_product_removed_from_the_catalogue(): void
    {
        // The badge was array_sum(session('cart')), so a product deleted by an
        // admin kept counting toward the cart bubble even though the cart page
        // and checkout both skip it.
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Kaos',
            'slug' => 'k-' . uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'is_active' => true,
        ]);
        $cart = [$product->id => 3];

        $product->delete();

        $this->actingAs($user)->withSession(['cart' => $cart])->get('/')
            ->assertOk()
            ->assertDontSee('badge rounded-pill');
    }

    public function test_badge_counts_live_products(): void
    {
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Kaos',
            'slug' => 'k-' . uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'is_active' => true,
        ]);

        $this->actingAs($user)->withSession(['cart' => [$product->id => 3]])->get('/')
            ->assertOk()
            ->assertSee('>3</span>', false);
    }
}
