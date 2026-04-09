<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name) . '-' . Str::lower(Str::random(5)),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(10_000, 1_000_000),
            'stock' => fake()->numberBetween(0, 50),
            'image' => null,
            'is_active' => true,
        ];
    }
}
