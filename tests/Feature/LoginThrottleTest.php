<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class LoginThrottleTest extends TestCase
{
    public function test_repeated_failed_logins_are_throttled(): void
    {
        // Without a rate limit the login form accepts unlimited guesses, so a
        // weak password is brute-forceable. Six attempts a minute is the limit;
        // the seventh must be blocked with 429.
        RateLimiter::clear('login');
        $user = User::factory()->create(['password' => bcrypt('secret123')]);

        for ($i = 0; $i < 6; $i++) {
            $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])
                ->assertRedirect();
        }

        $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])
            ->assertStatus(429);
    }
}
