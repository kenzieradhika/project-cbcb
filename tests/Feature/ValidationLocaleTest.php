<?php

namespace Tests\Feature;

use Tests\TestCase;

class ValidationLocaleTest extends TestCase
{
    public function test_registration_errors_are_in_indonesian(): void
    {
        // The UI is Indonesian (lang="id", every label), but APP_LOCALE was en,
        // so validation errors rendered in English under Indonesian labels.
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'x',
        ]);

        $response->assertSessionHasErrors();
        $errors = session('errors')->all();
        $this->assertStringContainsString('wajib diisi', $errors[0]);
        $this->assertStringNotContainsString('field is required', implode(' ', $errors));
    }
}
