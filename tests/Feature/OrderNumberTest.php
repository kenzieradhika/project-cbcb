<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderNumberTest extends TestCase
{
    public function test_generate_number_skips_a_value_that_is_already_taken(): void
    {
        // order_number carries a unique index. A random collision used to raise a
        // QueryException inside the checkout transaction, so the shopper lost the
        // order. generateNumber() must skip a value that is already in use.
        Order::factory()->create(['order_number' => 'ORD-TAKEN12345']);

        $calls = 0;
        Str::createRandomStringsUsing(function (int $length) use (&$calls): string {
            $calls++;

            return $calls === 1 ? 'TAKEN12345' : str_pad((string) $calls, 10, '0', STR_PAD_LEFT);
        });

        try {
            $this->assertSame('ORD-0000000002', Order::generateNumber());
        } finally {
            Str::createRandomStringsNormally();
        }
    }

    public function test_generated_numbers_are_unique(): void
    {
        $numbers = [];
        for ($i = 0; $i < 50; $i++) {
            $numbers[] = Order::generateNumber();
        }

        $this->assertCount(50, array_unique($numbers));
    }
}
