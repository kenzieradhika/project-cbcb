<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class AdminProductRoutesTest extends TestCase
{
    public function test_there_is_no_show_route_for_admin_products(): void
    {
        // Route::resource registered admin.products.show, but the controller has
        // no show() method, so GET /admin/products/{product} blew up with a 500.
        // The admin edits in place; drop the unused route instead.
        $this->assertFalse(
            app('router')->has('admin.products.show'),
            'the admin products resource should not expose a show route'
        );
    }

    public function test_getting_the_removed_show_url_is_not_a_server_error(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $product = Product::factory()->create();

        // Without the show route the URL matches no GET handler; it must not be a
        // 500 (a missing method) either way.
        $this->actingAs($admin)
            ->get("/admin/products/{$product->slug}")
            ->assertStatus(405);
    }
}
