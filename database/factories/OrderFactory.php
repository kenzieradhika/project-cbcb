<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'customer_name' => fake()->name(),
            'customer_phone' => null,
            'shipping_address' => fake()->address(),
            'status' => 'pending',
            'total' => fake()->numberBetween(10_000, 1_000_000),
        ];
    }
}
