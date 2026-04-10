<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class OrderAuthorizationTest extends TestCase
{
    public function test_a_shopper_cannot_view_another_users_order(): void
    {
        // The controller compares $order->user_id to the session user; a missing
        // check would leak any order (names, addresses) to any logged-in user.
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($other)->get("/orders/{$order->id}")->assertForbidden();
        $this->actingAs($owner)->get("/orders/{$order->id}")->assertOk();
    }

    public function test_an_admin_can_view_any_order_through_the_shop_route(): void
    {
        $owner = User::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($admin)->get("/orders/{$order->id}")->assertOk();
    }

    public function test_the_order_list_only_shows_the_signed_in_users_orders(): void
    {
        $me = User::factory()->create();
        Order::factory()->create(['user_id' => $me->id, 'order_number' => 'ORD-MINE']);
        Order::factory()->create(['order_number' => 'ORD-THEIRS']);

        $this->actingAs($me)->get('/orders')
            ->assertOk()
            ->assertSee('ORD-MINE')
            ->assertDontSee('ORD-THEIRS');
    }
}
