<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCartCountTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_empty_cart_counts_zero(): void
    {
        $this->assertSame(0, Product::cartCount([]));
    }

    public function test_it_sums_only_lines_that_are_still_orderable(): void
    {
        // The badge must agree with the cart page and checkout: a line whose
        // product is gone, inactive or out of stock is not orderable.
        $live = Product::factory()->create(['stock' => 5, 'is_active' => true]);
        $inactive = Product::factory()->create(['stock' => 5, 'is_active' => false]);
        $outOfStock = Product::factory()->create(['stock' => 0, 'is_active' => true]);

        $count = Product::cartCount([
            $live->id => 3,
            $inactive->id => 10,
            $outOfStock->id => 2,
            999999 => 7,
        ]);

        $this->assertSame(3, $count);
    }
}
