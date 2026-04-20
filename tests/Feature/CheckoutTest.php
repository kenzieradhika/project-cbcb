<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    private function product(int $stock = 5): Product
    {
        return Product::create([
            'name' => 'Kaos',
            'slug' => 'kaos-'.uniqid(),
            'description' => 'd',
            'price' => 1000,
            'stock' => $stock,
            'is_active' => true,
        ]);
    }

    public function test_checkout_without_a_phone_number_succeeds(): void
    {
        // customer_phone is nullable, so the validator drops the key when the
        // optional field is left blank. Reading $data['customer_phone'] directly
        // then raised "Undefined array key" and the order was never created.
        $user = User::factory()->create();
        $product = $this->product();

        $response = $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 2]])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'shipping_address' => 'Jl. Mawar 1',
            ]);

        $order = Order::firstOrFail();
        $response->assertRedirect(route('orders.show', $order));
        $this->assertNull($order->customer_phone);
        $this->assertSame('2000.00', $order->total);
        $this->assertSame(3, $product->fresh()->stock);
    }

    public function test_checkout_keeps_a_phone_number_when_given(): void
    {
        $user = User::factory()->create();
        $product = $this->product();

        $this->actingAs($user)
            ->withSession(['cart' => [$product->id => 1]])
            ->post('/checkout', [
                'customer_name' => 'Budi',
                'customer_phone' => '08123',
                'shipping_address' => 'Jl. Mawar 1',
            ]);

        $this->assertSame('08123', Order::firstOrFail()->customer_phone);
    }
}
