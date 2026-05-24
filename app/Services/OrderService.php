<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function __construct(private readonly CartService $cart) {}

    public function createFromCart(User $user, array $checkoutData): Order
    {
        $items = $this->cart->all();

        if ($items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        return DB::transaction(function () use ($user, $checkoutData, $items) {
            $subtotal = round($items->sum('line_total'), 2);

            $order = Order::query()->create([
                'user_id' => $user->id,
                'order_number' => $this->nextOrderNumber(),
                'full_name' => $checkoutData['full_name'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'delivery_address' => $checkoutData['delivery_address'],
                'city' => $checkoutData['city'],
                'payment_method' => $checkoutData['payment_method'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'total' => $subtotal,
            ]);

            foreach ($items as $item) {
                $product = Product::query()->lockForUpdate()->findOrFail($item['product_id']);

                if (! $product->isAvailable($item['quantity'])) {
                    throw ValidationException::withMessages([
                        'cart' => "{$product->name} does not have enough stock for checkout.",
                    ]);
                }

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total' => round((float) $product->price * $item['quantity'], 2),
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            $this->cart->clear();

            return $order->load('items');
        });
    }

    private function nextOrderNumber(): string
    {
        do {
            $number = 'YIP-'.now()->format('Ymd').'-'.str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (Order::query()->where('order_number', $number)->exists());

        return $number;
    }
}
