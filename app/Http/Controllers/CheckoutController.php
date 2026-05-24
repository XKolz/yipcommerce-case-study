<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(CartService $cart): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Add at least one product before checkout.');
        }

        return view('checkout.index', [
            'items' => $cart->all(),
            'subtotal' => $cart->subtotal(),
            'user' => auth()->user(),
        ]);
    }

    public function store(CheckoutRequest $request, OrderService $orders): RedirectResponse
    {
        $order = $orders->createFromCart($request->user(), $request->validated());

        return redirect()->route('checkout.success', $order)->with('success', 'Order placed successfully.');
    }

    public function success(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('checkout.success', [
            'order' => $order->load('items'),
        ]);
    }
}
