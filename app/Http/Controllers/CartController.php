<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartService $cart): View
    {
        return view('cart.index', [
            'items' => $cart->all(),
            'subtotal' => $cart->subtotal(),
            'totalQuantity' => $cart->totalQuantity(),
        ]);
    }

    public function add(Request $request, Product $product, CartService $cart): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:100000'],
        ]);

        $cart->add($product, (int) ($data['quantity'] ?? 1));

        return back()->with('success', "{$product->name} was added to your cart.");
    }

    public function update(Request $request, Product $product, CartService $cart): RedirectResponse
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100000'],
        ]);

        $cart->update($product, (int) $data['quantity']);

        return back()->with('success', 'Cart quantity updated.');
    }

    public function remove(Product $product, CartService $cart): RedirectResponse
    {
        $cart->remove($product);

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear(CartService $cart): RedirectResponse
    {
        $cart->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
