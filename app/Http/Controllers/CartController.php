<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        return view('customer.cart', compact('cart', 'totals'));
    }

    public function add(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'nullable|integer|min:1|max:50',
            'instructions' => 'nullable|string|max:200',
        ]);

        $food = Food::findOrFail($request->food_id);

        if (! $food->is_available) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'This food item is currently out of stock.'], 422);
            }

            return back()->with('error', 'This food item is currently out of stock.');
        }

        $cart = session()->get('cart', []);
        $id = $food->id;
        $qty = $request->input('quantity', 1);
        $instructions = $request->input('instructions', '');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
            if ($instructions) {
                $cart[$id]['instructions'] = $instructions;
            }
        } else {
            $cart[$id] = [
                'id' => $food->id,
                'name' => $food->name,
                'price' => (float) $food->price,
                'image' => $food->image,
                'quantity' => $qty,
                'instructions' => $instructions,
            ];
        }

        session()->put('cart', $cart);
        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$food->name} added to your cart!",
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'cart' => $cart,
                'totals' => $totals,
            ]);
        }

        return back()->with('success', "{$food->name} added to cart!");
    }

    public function update(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantity' => 'required|integer|min:0|max:50',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->food_id;
        $qty = (int) $request->quantity;

        if ($qty <= 0) {
            unset($cart[$id]);
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
        }

        session()->put('cart', $cart);
        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated.',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'cart' => $cart,
                'totals' => $totals,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'food_id' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->food_id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed.',
                'cart_count' => array_sum(array_column($cart, 'quantity')),
                'cart' => $cart,
                'totals' => $totals,
            ]);
        }

        return back()->with('info', 'Item removed from cart.');
    }

    public function clear(): RedirectResponse
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('info', 'Your cart is now empty.');
    }

    public static function calculateTotals(array $cart): array
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $deliveryFee = $subtotal > 0 ? 1.50 : 0.00;
        $total = $subtotal + $deliveryFee;

        return [
            'subtotal' => number_format($subtotal, 2, '.', ''),
            'delivery_fee' => number_format($deliveryFee, 2, '.', ''),
            'total' => number_format($total, 2, '.', ''),
            'raw_subtotal' => $subtotal,
            'raw_total' => $total,
        ];
    }
}
