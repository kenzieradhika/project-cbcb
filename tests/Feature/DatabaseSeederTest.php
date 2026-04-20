<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    public function test_seeding_twice_does_not_duplicate_the_catalogue(): void
    {
        // The users are firstOrCreate'd but products used create(), so running
        // `php artisan db:seed` a second time doubled the catalogue.
        $this->seed(DatabaseSeeder::class);
        $first = Product::count();
        $this->seed(DatabaseSeeder::class);

        $this->assertSame($first, Product::count());
        $this->assertSame(2, User::count());
        $this->assertSame(1, User::where('email', 'admin@tokokita.test')->count());
    }
}
