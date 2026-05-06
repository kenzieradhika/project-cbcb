<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminImageLocaleTest extends TestCase
{
    public function test_an_oversized_image_error_is_in_indonesian(): void
    {
        // The image rule set ends in max:2048. For a file that is the max.file
        // key, which lang/id/validation.php did not define, so the upload error
        // rendered in English under an otherwise Indonesian form.
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Kaos',
            'description' => 'd',
            'price' => 1000,
            'stock' => 1,
            'image' => UploadedFile::fake()->create('big.jpg', 3000, 'image/jpeg'),
        ])->assertSessionHasErrors('image');

        $message = session('errors')->first('image');

        $this->assertStringContainsString('maksimal', $message);
        $this->assertStringNotContainsString('must not be greater', $message);
        $this->assertSame(0, Product::count());
    }
}
