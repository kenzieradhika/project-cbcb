<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (!$product || $product->stock < 1) {
                continue;
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

        $order = DB::transaction(function () use ($cart, $data) {
            $total = 0;
            $items = [];

            foreach ($cart as $productId => $quantity) {
                $product = Product::lockForUpdate()->find($productId);
                if (!$product || $product->stock < $quantity) {
                    throw new \Exception("Stok produk {$product?->name} tidak mencukupi.");
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
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
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

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat!');
    }
}