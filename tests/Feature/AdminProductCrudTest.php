<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class AdminProductCrudTest extends TestCase
{
    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_an_admin_can_create_a_product(): void
    {
        $this->actingAs($this->admin())->post('/admin/products', [
            'name' => 'Kaos Baru',
            'description' => 'Deskripsi',
            'price' => 25000,
            'stock' => 10,
            'is_active' => '1',
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::firstOrFail();
        $this->assertSame('Kaos Baru', $product->name);
        $this->assertTrue($product->is_active);
        $this->assertNotEmpty($product->slug);
    }

    public function test_creating_without_a_name_fails_validation(): void
    {
        $this->actingAs($this->admin())->post('/admin/products', [
            'name' => '',
            'description' => 'd',
            'price' => 1000,
            'stock' => 1,
        ])->assertSessionHasErrors('name');

        $this->assertSame(0, Product::count());
    }

    public function test_the_switch_off_marks_a_product_inactive(): void
    {
        // An unchecked checkbox sends nothing, so the controller must read the
        // boolean as false rather than treating a missing key as "keep active".
        $product = Product::factory()->create(['is_active' => true]);

        $this->actingAs($this->admin())->put("/admin/products/{$product->slug}", [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
        ]);

        $this->assertFalse($product->fresh()->is_active);
    }

    public function test_updating_keeps_the_slug_stable(): void
    {
        // Renaming must not change the slug: existing links and the sitemap would
        // 404 otherwise.
        $product = Product::factory()->create(['name' => 'Nama Lama']);
        $slug = $product->slug;

        $this->actingAs($this->admin())->put("/admin/products/{$slug}", [
            'name' => 'Nama Baru',
            'description' => $product->description,
            'price' => $product->price,
            'stock' => $product->stock,
            'is_active' => '1',
        ]);

        $this->assertSame('Nama Baru', $product->fresh()->name);
        $this->assertSame($slug, $product->fresh()->slug);
    }

    public function test_a_shopper_cannot_create_a_product(): void
    {
        $shopper = User::factory()->create(['is_admin' => false]);

        $this->actingAs($shopper)->post('/admin/products', [
            'name' => 'X',
            'description' => 'd',
            'price' => 1,
            'stock' => 1,
        ])->assertForbidden();

        $this->assertSame(0, Product::count());
    }
}
