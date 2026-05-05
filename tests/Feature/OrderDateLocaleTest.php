<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class OrderDateLocaleTest extends TestCase
{
    public function test_the_order_list_shows_indonesian_month_names(): void
    {
        // The UI is Indonesian (lang="id", APP_LOCALE=id), but the order table
        // used format('d M Y H:i'), which prints the English month abbreviation
        // ("May") next to every other Indonesian string.
        $user = User::factory()->create();
        Order::factory()->create([
            'user_id' => $user->id,
            'order_number' => 'ORD-MEI',
            'created_at' => '2026-05-03 09:00:00',
            'updated_at' => '2026-05-03 09:00:00',
        ]);

        $this->actingAs($user)->get('/orders')
            ->assertOk()
            ->assertSee('03 Mei 2026')
            ->assertDontSee('03 May 2026');
    }
}
