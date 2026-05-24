<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CartService
{
    private const SESSION_KEY = 'cart.items';

    public function all(): Collection
    {
        $cart = collect(Session::get(self::SESSION_KEY, []));

        if ($cart->isEmpty()) {
            return collect();
        }

        $products = Product::query()
            ->whereIn('id', $cart->keys())
            ->get()
            ->keyBy('id');

        $items = $cart->map(function (array $item, int|string $productId) use ($products) {
            $product = $products->get((int) $productId);

            if (! $product) {
                return null;
            }

            $quantity = min((int) $item['quantity'], max($product->stock, 0));

            return [
                'product' => $product,
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image_url' => $product->image_url,
                'price' => (float) $product->price,
                'quantity' => $quantity,
                'stock' => $product->stock,
                'line_total' => round((float) $product->price * $quantity, 2),
            ];
        })->filter()->values();

        $this->persist($items->mapWithKeys(fn (array $item) => [
            $item['product_id'] => ['quantity' => $item['quantity']],
        ])->all());

        return $items;
    }

    public function add(Product $product, int $quantity = 1): void
    {
        $quantity = max(1, $quantity);
        $cart = Session::get(self::SESSION_KEY, []);
        $currentQuantity = (int) ($cart[$product->id]['quantity'] ?? 0);
        $newQuantity = $currentQuantity + $quantity;

        $this->ensureAvailable($product, $newQuantity);

        $cart[$product->id] = ['quantity' => $newQuantity];
        $this->persist($cart);
    }

    public function update(Product $product, int $quantity): void
    {
        $quantity = max(1, $quantity);
        $this->ensureAvailable($product, $quantity);

        $cart = Session::get(self::SESSION_KEY, []);
        $cart[$product->id] = ['quantity' => $quantity];
        $this->persist($cart);
    }

    public function remove(Product $product): void
    {
        $cart = Session::get(self::SESSION_KEY, []);
        unset($cart[$product->id]);
        $this->persist($cart);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function subtotal(): float
    {
        return round($this->all()->sum('line_total'), 2);
    }

    public function totalQuantity(): int
    {
        return (int) $this->all()->sum('quantity');
    }

    public function isEmpty(): bool
    {
        return $this->all()->isEmpty();
    }

    private function ensureAvailable(Product $product, int $quantity): void
    {
        if ($product->status !== Product::STATUS_ACTIVE) {
            throw ValidationException::withMessages([
                'product' => 'This product is currently unavailable.',
            ]);
        }

        if ($quantity > $product->stock) {
            throw ValidationException::withMessages([
                'quantity' => "Only {$product->stock} item(s) are available in stock.",
            ]);
        }
    }

    private function persist(array $cart): void
    {
        Session::put(self::SESSION_KEY, array_filter($cart, fn (array $item) => (int) $item['quantity'] > 0));
    }
}
