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
            'userCount' => User::count(),
            'revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'latestOrders' => Order::with('user')->latest()->limit(5)->get(),
        ]);
    }
}