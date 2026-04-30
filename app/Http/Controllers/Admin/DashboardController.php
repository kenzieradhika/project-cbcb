<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'orderCount' => Order::count(),
            // The card is labelled "Pelanggan" (customers); counting admins too
            // overstated the shopper base by one on every install.
            'userCount' => User::where('is_admin', false)->count(),
            // Revenue is money actually collected. Pending orders are not paid
            // yet and cancelled ones never will be, so count only settled states.
            'revenue' => Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total'),
            'latestOrders' => Order::with('user')->latest()->limit(5)->get(),
        ]);
    }
}
