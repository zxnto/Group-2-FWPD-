<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['items.food', 'restaurant'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(string $orderNumber): View
    {
        $order = Order::with(['items.food', 'restaurant', 'payments', 'reviews'])
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('customer.orders.show', compact('order'));
    }

    public function trackStatusApi(string $orderNumber): JsonResponse
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json([
            'status' => $order->status,
            'progress' => $order->getProgressPercentage(),
            'badge_class' => $order->getStatusBadgeClass(),
            'confirmed_at' => $order->confirmed_at ? $order->confirmed_at->format('h:i A') : null,
            'preparing_at' => $order->preparing_at ? $order->preparing_at->format('h:i A') : null,
            'out_for_delivery_at' => $order->out_for_delivery_at ? $order->out_for_delivery_at->format('h:i A') : null,
            'delivered_at' => $order->delivered_at ? $order->delivered_at->format('h:i A') : null,
        ]);
    }

    public function cancel(Request $request, string $orderNumber): RedirectResponse
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (! $order->canCancel()) {
            return back()->with('error', "Order cannot be cancelled because it is already {$order->status}.");
        }

        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        $order->update([
            'status' => 'Cancelled',
            'cancelled_reason' => $request->input('reason', 'Cancelled by customer'),
        ]);

        return back()->with('info', 'Your order has been cancelled.');
    }

    public function submitReview(Request $request, string $orderNumber): RedirectResponse
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'Delivered') {
            return back()->with('error', 'You can only review delivered orders.');
        }

        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'food_id' => $request->food_id,
                'order_id' => $order->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Thank you for your rating and review!');
    }
}
