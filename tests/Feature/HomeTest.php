<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_lists_only_active_products(): void
    {
        Product::factory()->create(['name' => 'Kaos Aktif', 'is_active' => true]);
        Product::factory()->create(['name' => 'Kaos Nonaktif', 'is_active' => false]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kaos Aktif')
            ->assertDontSee('Kaos Nonaktif');
    }

    public function test_home_shows_an_empty_state_with_no_products(): void
    {
        $this->get('/')->assertOk()->assertSee('Belum ada produk');
    }

    public function test_product_page_404s_for_an_inactive_product(): void
    {
        $product = Product::factory()->create(['is_active' => false]);

        $this->get("/products/{$product->slug}")->assertNotFound();
    }

    public function test_an_admin_can_reach_the_dashboard_but_a_shopper_cannot(): void
    {
        $shopper = User::factory()->create(['is_admin' => false]);
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($shopper)->get('/admin')->assertForbidden();
        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_a_guest_is_redirected_from_the_admin_area(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }
}
