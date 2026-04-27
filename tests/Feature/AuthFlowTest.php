<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    public function test_a_new_user_is_registered_and_signed_in(): void
    {
        $this->post('/register', [
            'name' => 'Budi',
            'email' => 'budi@example.test',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'budi@example.test', 'is_admin' => false]);
    }

    public function test_registration_rejects_a_mismatched_confirmation(): void
    {
        $this->post('/register', [
            'name' => 'Budi',
            'email' => 'budi@example.test',
            'password' => 'secret123',
            'password_confirmation' => 'different',
        ])->assertSessionHasErrors('password');

        $this->assertGuest();
        $this->assertSame(0, User::count());
    }

    public function test_login_with_valid_credentials_redirects_home(): void
    {
        User::factory()->create(['email' => 'budi@example.test', 'password' => bcrypt('secret123')]);

        $this->post('/login', ['email' => 'budi@example.test', 'password' => 'secret123'])
            ->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }

    public function test_login_with_a_wrong_password_reports_an_error(): void
    {
        User::factory()->create(['email' => 'budi@example.test', 'password' => bcrypt('secret123')]);

        $this->from('/login')
            ->post('/login', ['email' => 'budi@example.test', 'password' => 'wrong'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_logout_ends_the_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout')->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_a_guest_cannot_open_the_cart(): void
    {
        $this->get('/cart')->assertRedirect(route('login'));
    }
}
