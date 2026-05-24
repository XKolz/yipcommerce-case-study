<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->active()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('search')->toString().'%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'search' => $request->string('search')->toString(),
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->status === Product::STATUS_ACTIVE, 404);

        $relatedProducts = Product::query()
            ->active()
            ->whereKeyNot($product->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
