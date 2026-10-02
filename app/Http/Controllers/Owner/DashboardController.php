<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\Review;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Summary KPIs
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', '!=', 'Cancelled')
            ->sum('total_amount');

        $totalRevenue = Order::where('status', '!=', 'Cancelled')
            ->sum('total_amount');

        $totalOrders = Order::count();

        $activeOrders = Order::whereIn('status', ['Pending', 'Confirmed', 'Preparing', 'Out for Delivery'])
            ->count();

        $totalFoods = Food::count();

        // Recent Orders
        $recentOrders = Order::with(['items', 'user'])
            ->latest()
            ->take(8)
            ->get();

        // Top Selling Foods
        $topFoods = Food::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        // Recent Customer Reviews
        $recentReviews = Review::with(['user', 'food'])
            ->latest()
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'todayRevenue',
            'totalRevenue',
            'totalOrders',
            'activeOrders',
            'totalFoods',
            'recentOrders',
            'topFoods',
            'recentReviews'
        ));
    }
}
