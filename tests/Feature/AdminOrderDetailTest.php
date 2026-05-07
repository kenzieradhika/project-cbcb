<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class AdminOrderDetailTest extends TestCase
{
    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_the_admin_order_detail_page_shows_the_snapshot_lines(): void
    {
        // The line keeps the name and price from purchase time, so an admin can
        // still read an order after the product is renamed or deleted.
        $order = Order::factory()->create(['customer_name' => 'Budi Santoso']);
        $order->items()->create([
            'product_name' => 'Kaos Lawas',
            'price' => 1000,
            'quantity' => 2,
            'subtotal' => 2000,
        ]);

        $this->actingAs($this->admin())
            ->get("/admin/orders/{$order->id}")
            ->assertOk()
            ->assertSee('Kaos Lawas')
            ->assertSee('Budi Santoso');
    }

    public function test_an_unknown_status_is_rejected(): void
    {
        $order = Order::factory()->create(['status' => 'pending']);

        $this->actingAs($this->admin())
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'refunded'])
            ->assertSessionHasErrors('status');

        $this->assertSame('pending', $order->fresh()->status);
    }

    public function test_a_shopper_cannot_change_an_order_status(): void
    {
        $order = Order::factory()->create(['status' => 'pending']);

        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->patch("/admin/orders/{$order->id}/status", ['status' => 'paid'])
            ->assertForbidden();

        $this->assertSame('pending', $order->fresh()->status);
    }
}
