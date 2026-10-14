<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductImageUrlTest extends TestCase
{
    private function product(array $attrs = []): Product
    {
        return Product::create(array_merge([
            'name' => 'Kaos',
            'slug' => 'kaos-' . uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 1,
            'is_active' => true,
        ], $attrs));
    }

    public function test_an_uploaded_path_becomes_a_storage_url(): void
    {
        // Admin uploads store "products/ab.jpg"; using that raw as <img src>
        // makes the browser request /products/ab.jpg on the app host (404).
        // Storage::url() resolves it to the public disk's /storage path.
        $product = $this->product(['image' => 'products/ab.jpg']);

        $this->assertSame(url('/storage/products/ab.jpg'), $product->image_url);
        $this->assertStringEndsWith('/storage/products/ab.jpg', $product->image_url);
    }

    public function test_an_absolute_url_is_left_alone(): void
    {
        // The seeder stores full https URLs (picsum); those must not be prefixed.
        $product = $this->product(['image' => 'https://picsum.photos/seed/x/600/400']);

        $this->assertSame('https://picsum.photos/seed/x/600/400', $product->image_url);
    }

    public function test_no_image_yields_null(): void
    {
        $this->assertNull($this->product(['image' => null])->image_url);
    }
}
