<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,shipped,completed,cancelled'],
        ]);

        $status = $request->input('status');

        // Cancelling an order must return its items to stock, and un-cancelling a
        // cancelled order must take them back out -- otherwise stock drifts from
        // the catalogue on every status flip.
        $restock = $status === 'cancelled' && $order->status !== 'cancelled';
        $unstock = $status !== 'cancelled' && $order->status === 'cancelled';

        // Un-cancelling re-commits the units to the order. If they were sold in
        // the meantime there is nothing left to take, and incrementing by a
        // negative amount would drive stock below zero. Refuse instead.
        if ($unstock) {
            foreach ($order->items as $item) {
                if (! $item->product_id) {
                    continue;
                }
                $product = $item->product;
                if ($product && $product->stock < $item->quantity) {
                    return back()->with('error', "Stok {$product->name} tidak cukup untuk mengaktifkan kembali pesanan ini.");
                }
            }
        }

        DB::transaction(function () use ($order, $status, $restock, $unstock) {
            if ($restock || $unstock) {
                foreach ($order->items as $item) {
                    if (! $item->product_id) {
                        continue;  // product was deleted; nothing to restock
                    }
                    $item->product()->increment('stock', $restock ? $item->quantity : -$item->quantity);
                }
            }

            $order->update(['status' => $status]);
        });

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
