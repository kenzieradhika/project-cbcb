<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    public function test_seeding_twice_does_not_duplicate_the_catalogue(): void
    {
        // The users are firstOrCreate'd but products used create(), so running
        // `php artisan db:seed` a second time doubled the catalogue.
        $this->seed(DatabaseSeeder::class);
        $first = \App\Models\Product::count();
        $this->seed(DatabaseSeeder::class);

        $this->assertSame($first, \App\Models\Product::count());
        $this->assertSame(2, \App\Models\User::count());
        $this->assertSame(1, \App\Models\User::where('email', 'admin@tokokita.test')->count());
    }
}
