<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    private function order(string $status, int $total): void
    {
        Order::create([
            'user_id' => User::factory()->create()->id,
            'order_number' => 'ORD-' . uniqid(),
            'customer_name' => 'Budi',
            'shipping_address' => 'Jl. Mawar 1',
            'status' => $status,
            'total' => $total,
        ]);
    }

    public function test_revenue_counts_only_settled_orders(): void
    {
        // The old query was `status != cancelled`, so an unpaid pending order was
        // reported as revenue the shop had not actually earned.
        $this->order('pending', 111111);
        $this->order('paid', 50000);
        $this->order('shipped', 25000);
        $this->order('completed', 10000);
        $this->order('cancelled', 999999);

        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)->get('/admin')
            ->assertOk()
            ->assertSee('85.000')       // number_format(85000, 0, ',', '.')
            ->assertDontSee('196.111'); // the old sum that included the pending order
    }
}
