<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::query()->count(),
            'totalOrders' => Order::query()->count(),
            'pendingOrders' => Order::query()->where('status', 'pending')->count(),
            'totalRevenue' => Order::query()
                ->where('status', 'completed')
                ->where('payment_status', 'paid')
                ->sum('total'),
            'recentOrders' => Order::query()
                ->with('user')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }
}
