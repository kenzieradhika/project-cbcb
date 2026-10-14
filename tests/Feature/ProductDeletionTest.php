<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class ProductDeletionTest extends TestCase
{
    public function test_deleting_an_ordered_product_keeps_the_order_intact(): void
    {
        // order_items snapshots the product name/price, so an order must survive
        // its product being deleted. The old `constrained()` FK was RESTRICT, so
        // deleting an ever-ordered product raised a foreign-key error.
        $user = User::factory()->create();
        $product = Product::create([
            'name' => 'Kaos',
            'slug' => 'kaos-' . uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => 5,
            'is_active' => true,
        ]);
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . uniqid(),
            'customer_name' => 'Budi',
            'shipping_address' => 'Jl. Mawar 1',
            'status' => 'pending',
            'total' => 2000,
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => 1000,
            'quantity' => 2,
            'subtotal' => 2000,
        ]);

        $product->delete();

        $item = OrderItem::firstOrFail();
        $this->assertNull($item->product_id);
        $this->assertSame('Kaos', $item->product_name);
        $this->assertSame('2000.00', $item->subtotal);
    }
}
