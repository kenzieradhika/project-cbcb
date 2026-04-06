<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class EmailCaseTest extends TestCase
{
    public function test_registration_lowercases_the_email(): void
    {
        // SQLite's unique index is case-sensitive, so without normalisation
        // "Bob@x.test" and "bob@x.test" became two separate accounts.
        $this->post('/register', [
            'name' => 'Budi',
            'email' => 'Budi@Example.test',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'budi@example.test']);
        $this->assertSame(1, User::count());
    }

    public function test_a_second_registration_with_a_different_case_is_rejected(): void
    {
        User::factory()->create(['email' => 'budi@example.test']);

        $this->post('/register', [
            'name' => 'Budi Lain',
            'email' => 'BUDI@example.test',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertSessionHasErrors('email');

        $this->assertSame(1, User::count());
    }

    public function test_login_accepts_a_different_email_case(): void
    {
        User::factory()->create([
            'email' => 'budi@example.test',
            'password' => bcrypt('secret123'),
        ]);

        $this->post('/login', ['email' => 'BUDI@Example.test', 'password' => 'secret123'])
            ->assertRedirect(route('home'));
        $this->assertAuthenticated();
    }
}
