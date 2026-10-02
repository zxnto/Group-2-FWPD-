<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        // 1. Revenue by Payment Method
        $paymentBreakdown = Order::where('status', '!=', 'Cancelled')
            ->select('payment_method', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_amount) as total_revenue'))
            ->groupBy('payment_method')
            ->get();

        // 2. Sales by Food Category
        $categoriesWithSales = Category::with(['foods.orderItems'])
            ->get()
            ->map(function ($cat) {
                $revenue = 0;
                $itemsSold = 0;
                foreach ($cat->foods as $food) {
                    foreach ($food->orderItems as $item) {
                        $itemsSold += $item->quantity;
                        $revenue += $item->subtotal;
                    }
                }

                return [
                    'name' => $cat->name,
                    'items_sold' => $itemsSold,
                    'revenue' => $revenue,
                ];
            });

        // 3. Customer Information Roster
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->with(['orders' => function ($q) {
                $q->where('status', '!=', 'Cancelled');
            }])
            ->get()
            ->map(function ($cust) {
                $totalSpent = $cust->orders->sum('total_amount');

                return [
                    'id' => $cust->id,
                    'name' => $cust->name,
                    'email' => $cust->email,
                    'phone' => $cust->phone,
                    'address' => $cust->address,
                    'orders_count' => $cust->orders_count,
                    'total_spent' => $totalSpent,
                    'joined_at' => $cust->created_at->format('M d, Y'),
                ];
            });

        // 4. All Customer Reviews
        $reviews = Review::with(['user', 'food'])->latest()->paginate(15);

        return view('owner.reports.index', compact('paymentBreakdown', 'categoriesWithSales', 'customers', 'reviews'));
    }
}
