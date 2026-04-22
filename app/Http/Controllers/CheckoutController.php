<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (! $product || ! $product->is_active || $product->stock < 1) {
                continue;
            }
            // A line whose quantity now exceeds stock cannot be ordered as
            // stored. Sending the user to the cart to adjust beats showing a
            // total that store() would then reject.
            if ($quantity > $product->stock) {
                return redirect()->route('cart.index')->with(
                    'error',
                    "Stok {$product->name} tinggal {$product->stock}. Sesuaikan jumlahnya dulu."
                );
            }
            $items[] = ['product' => $product, 'quantity' => $quantity];
            $total += $product->price * $quantity;
        }

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
            'shipping_address' => ['required', 'string', 'max:1000'],
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        try {
            $order = DB::transaction(function () use ($cart, $data) {
                $total = 0;
                $items = [];

                foreach ($cart as $productId => $quantity) {
                    $product = Product::lockForUpdate()->find($productId);
                    if (! $product || ! $product->is_active || $product->stock < $quantity) {
                        // ValidationException (not a bare \Exception) so the
                        // controller redirects back with the message on the form
                        // instead of surfacing a 500 page.
                        throw ValidationException::withMessages([
                            'cart' => 'Stok produk '.($product?->name ?? "#{$productId}").' tidak mencukupi.',
                        ]);
                    }

                    $subtotal = $product->price * $quantity;
                    $total += $subtotal;
                    $items[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];

                    $product->decrement('stock', $quantity);
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'order_number' => Order::generateNumber(),
                    'customer_name' => $data['customer_name'],
                    'customer_phone' => $data['customer_phone'] ?? null,
                    'shipping_address' => $data['shipping_address'],
                    'status' => 'pending',
                    'total' => $total,
                ]);

                foreach ($items as $item) {
                    $order->items()->create([
                        'product_id' => $item['product']->id,
                        'product_name' => $item['product']->name,
                        'price' => $item['product']->price,
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['subtotal'],
                    ]);
                }

                return $order;
            });
        } catch (ValidationException $e) {
            return back()->with('error', $e->validator->errors()->first('cart'));
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat!');
    }
}
