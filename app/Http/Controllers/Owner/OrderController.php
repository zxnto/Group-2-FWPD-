<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $query = Order::with(['items.food', 'user'])->latest();

        if ($status && in_array($status, ['Pending', 'Confirmed', 'Preparing', 'Out for Delivery', 'Delivered', 'Cancelled'])) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(15)->withQueryString();

        // Status counts for badge tabs
        $counts = [
            'all' => Order::count(),
            'Pending' => Order::where('status', 'Pending')->count(),
            'Confirmed' => Order::where('status', 'Confirmed')->count(),
            'Preparing' => Order::where('status', 'Preparing')->count(),
            'Out for Delivery' => Order::where('status', 'Out for Delivery')->count(),
            'Delivered' => Order::where('status', 'Delivered')->count(),
            'Cancelled' => Order::where('status', 'Cancelled')->count(),
        ];

        return view('owner.orders.index', compact('orders', 'counts', 'status'));
    }

    public function show(int $id): View
    {
        $order = Order::with(['items.food', 'user', 'payments', 'reviews'])->findOrFail($id);

        return view('owner.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Preparing,Out for Delivery,Delivered,Cancelled',
            'reason' => 'nullable|string|max:255',
        ]);

        $newStatus = $request->input('status');
        $updates = ['status' => $newStatus];

        if ($newStatus === 'Confirmed' && ! $order->confirmed_at) {
            $updates['confirmed_at'] = now();
        } elseif ($newStatus === 'Preparing' && ! $order->preparing_at) {
            $updates['preparing_at'] = now();
        } elseif ($newStatus === 'Out for Delivery' && ! $order->out_for_delivery_at) {
            $updates['out_for_delivery_at'] = now();
        } elseif ($newStatus === 'Delivered') {
            if (! $order->delivered_at) {
                $updates['delivered_at'] = now();
            }
            $updates['payment_status'] = 'paid';

            // Mark COD payment paid as well
            Payment::where('order_id', $order->id)
                ->where('payment_method', 'cod')
                ->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
        } elseif ($newStatus === 'Cancelled') {
            $updates['cancelled_reason'] = $request->input('reason', 'Cancelled by restaurant');
        }

        $order->update($updates);

        return back()->with('success', "Order #{$order->order_number} status updated to {$newStatus}!");
    }
}
