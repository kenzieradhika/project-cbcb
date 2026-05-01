<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminProductFormTest extends TestCase
{
    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_the_create_form_defaults_to_active(): void
    {
        $this->actingAs($this->admin())->get('/admin/products/create')
            ->assertOk()
            ->assertSee('id="isActive"', false)
            ->assertSee('checked', false);
    }

    public function test_the_switch_stays_off_after_a_failed_create(): void
    {
        // An unchecked checkbox sends nothing, so it was absent from the flashed
        // old input. `old('is_active', $product?->is_active ?? true)` then fell
        // back to true and re-checked the switch the admin had just turned off.
        $admin = $this->admin();

        $this->actingAs($admin)->post('/admin/products', [
            'name' => '',
            'description' => 'd',
            'price' => 1000,
            'stock' => 1,
            'is_active' => '0', // the hidden field the switch sits next to
        ])->assertSessionHasErrors('name');

        $html = $this->actingAs($admin)->get('/admin/products/create')->getContent();

        $this->assertStringContainsString('name="is_active" value="0"', $html);
        $this->assertStringNotContainsString('id="isActive" checked', $html);
    }
}
