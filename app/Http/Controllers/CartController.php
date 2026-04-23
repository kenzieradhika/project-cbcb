<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function cart(): array
    {
        return Session::get('cart', []);
    }

    private function saveCart(array $cart): void
    {
        Session::put('cart', $cart);
    }

    public function index()
    {
        $cart = $this->cart();
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            // Same skip rule as checkout: a line whose product is gone, inactive
            // or out of stock must not count toward the total, or the cart page
            // and the checkout summary would disagree.
            if (! $product || ! $product->is_active || $product->stock < 1) {
                continue;
            }
            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
            $total += $product->price * $quantity;
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        if (! $product->is_active) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.max($product->stock, 1)],
        ]);

        $cart = $this->cart();
        $qty = (int) $request->input('quantity', 1);

        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;

        if ($cart[$product->id] > $product->stock) {
            $cart[$product->id] = $product->stock;
        }

        $this->saveCart($cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $cart = $this->cart();

        // update() is the qty field on the cart page; it must only ever change a
        // line that is already there. A crafted PATCH to a product not in the
        // cart used to insert it.
        if (! array_key_exists($product->id, $cart)) {
            return back()->with('error', 'Produk tidak ada di keranjang.');
        }

        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.max($product->stock, 1)],
        ]);

        $cart[$product->id] = (int) $request->input('quantity');
        $this->saveCart($cart);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Product $product)
    {
        $cart = $this->cart();
        unset($cart[$product->id]);
        $this->saveCart($cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function count(): int
    {
        return array_sum($this->cart());
    }
}
