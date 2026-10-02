<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty. Please add items before checking out.');
        }

        $totals = CartController::calculateTotals($cart);
        $user = Auth::user();
        $addresses = $user ? $user->addresses : collect();
        $defaultAddress = $addresses->firstWhere('is_default', true) ?? $addresses->first();

        return view('customer.checkout', compact('cart', 'totals', 'addresses', 'defaultAddress'));
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Cart is empty.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:25',
            'payment_method' => 'required|in:cod,abapay,card',
            'delivery_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
            'address_id' => 'nullable|exists:addresses,id',
            'save_address' => 'nullable|boolean',
            'address_label' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $restaurant = Restaurant::where('is_active', true)->first();
        $totals = CartController::calculateTotals($cart);

        DB::beginTransaction();
        try {
            // Optional: Save new address if requested
            $addressId = $request->address_id;
            if ($request->boolean('save_address') && ! $addressId && $user) {
                $newAddress = Address::create([
                    'user_id' => $user->id,
                    'label' => $request->input('address_label', 'Delivery Address'),
                    'recipient_name' => $request->customer_name,
                    'recipient_phone' => $request->customer_phone,
                    'address' => $request->delivery_address,
                    'is_default' => $user->addresses()->count() === 0,
                ]);
                $addressId = $newAddress->id;
            }

            $orderNumber = 'ORD-'.strtoupper(Str::random(8));

            // Set initial status based on payment
            $paymentMethod = $request->payment_method;
            $isPaidOnline = in_array($paymentMethod, ['abapay', 'card']);
            $initialStatus = 'Pending';
            $paymentStatus = $isPaidOnline ? 'paid' : 'pending';

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'restaurant_id' => $restaurant ? $restaurant->id : null,
                'address_id' => $addressId,
                'delivery_address' => $request->delivery_address,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'subtotal' => $totals['raw_subtotal'],
                'delivery_fee' => $totals['delivery_fee'],
                'total_amount' => $totals['raw_total'],
                'status' => $initialStatus,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'notes' => $request->notes,
                'confirmed_at' => $isPaidOnline ? now() : null,
            ]);

            // Save order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => $item['id'],
                    'food_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'instructions' => $item['instructions'] ?? null,
                ]);
            }

            // Record payment details
            $txnId = match ($paymentMethod) {
                'abapay' => 'ABA-KHQR-'.rand(10000000, 99999999),
                'card' => 'STRIPE-TEST-'.rand(10000000, 99999999),
                default => 'COD-'.rand(100000, 999999),
            };

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $paymentMethod,
                'transaction_id' => $txnId,
                'amount' => $totals['raw_total'],
                'status' => $paymentStatus,
                'payload' => json_encode([
                    'gateway' => $paymentMethod,
                    'mock_verified' => true,
                    'timestamp' => now()->toIso8601String(),
                ]),
                'paid_at' => $isPaidOnline ? now() : null,
            ]);

            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order->order_number)
                ->with('success', "Order #{$order->order_number} placed successfully! Thank you for ordering.");

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Failed to place order: '.$e->getMessage());
        }
    }
}
