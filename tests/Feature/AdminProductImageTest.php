<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductImageTest extends TestCase
{
    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function product(array $attrs = []): Product
    {
        return Product::create(array_merge([
            'name' => 'Kaos',
            'slug' => 'kaos-'.uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'is_active' => true,
        ], $attrs));
    }

    public function test_replacing_an_image_deletes_the_old_file(): void
    {
        Storage::fake('public');
        $product = $this->product(['image' => 'products/old.jpg']);
        Storage::disk('public')->put('products/old.jpg', 'x');

        $this->actingAs($this->admin())->put("/admin/products/{$product->slug}", [
            'name' => 'Kaos',
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'image' => UploadedFile::fake()->create('new.jpg', 5, 'image/jpeg'),
        ]);

        Storage::disk('public')->assertMissing('products/old.jpg');
        $this->assertNotSame('products/old.jpg', $product->fresh()->image);
    }

    public function test_deleting_a_product_deletes_its_uploaded_image(): void
    {
        Storage::fake('public');
        $product = $this->product(['image' => 'products/gone.jpg']);
        Storage::disk('public')->put('products/gone.jpg', 'x');

        $this->actingAs($this->admin())->delete("/admin/products/{$product->slug}");

        Storage::disk('public')->assertMissing('products/gone.jpg');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_seeded_absolute_url_is_never_deleted(): void
    {
        // picsum URLs are not files on our disk; deleting a product that uses one
        // must not try to touch the public disk with an https string.
        Storage::fake('public');
        $product = $this->product(['image' => 'https://picsum.photos/seed/x/600/400']);

        $this->actingAs($this->admin())->delete("/admin/products/{$product->slug}");

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
