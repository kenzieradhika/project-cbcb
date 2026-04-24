<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class AdminOrderStatusTest extends TestCase
{
    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    /** An order for 2 units, with stock already decremented as checkout does. */
    private function orderFor(Product $product): Order
    {
        $order = Order::create([
            'user_id' => User::factory()->create()->id,
            'order_number' => 'ORD-'.uniqid(),
            'customer_name' => 'Budi',
            'shipping_address' => 'Jl. Mawar 1',
            'status' => 'pending',
            'total' => $product->price * 2,
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => 2,
            'subtotal' => $product->price * 2,
        ]);

        return $order;
    }

    private function product(int $stock): Product
    {
        return Product::create([
            'name' => 'Kaos',
            'slug' => 'kaos-'.uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => $stock,
            'is_active' => true,
        ]);
    }

    public function test_cancelling_an_order_returns_stock(): void
    {
        // Checkout decremented stock; cancelling never put it back, so every
        // cancelled order leaked inventory permanently.
        $product = $this->product(3);
        $order = $this->orderFor($product);

        $this->actingAs($this->admin())
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'cancelled']);

        $this->assertSame(5, $product->fresh()->stock);
        $this->assertSame('cancelled', $order->fresh()->status);
    }

    public function test_uncancelling_an_order_takes_stock_back_out(): void
    {
        $product = $this->product(3);
        $order = $this->orderFor($product);
        $order->update(['status' => 'cancelled']);

        $this->actingAs($this->admin())
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'paid']);

        $this->assertSame(1, $product->fresh()->stock);
    }

    public function test_other_status_changes_do_not_touch_stock(): void
    {
        $product = $this->product(3);
        $order = $this->orderFor($product);

        $this->actingAs($this->admin())
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'shipped']);

        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_uncancelling_is_refused_when_the_stock_was_resold(): void
    {
        // Cancel returns the units; if they sell out afterwards, un-cancelling
        // used to increment by a negative and drive stock below zero.
        $product = $this->product(3);
        $order = $this->orderFor($product);
        $admin = $this->admin();

        $this->actingAs($admin)
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'cancelled']);
        $this->assertSame(5, $product->fresh()->stock);

        // Someone else buys the returned stock.
        $product->update(['stock' => 0]);

        $this->actingAs($admin)
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'paid'])
            ->assertSessionHas('error');

        $this->assertSame(0, $product->fresh()->stock);
        $this->assertSame('cancelled', $order->fresh()->status);
    }
}
