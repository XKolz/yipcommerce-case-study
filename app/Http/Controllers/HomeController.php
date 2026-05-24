<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SmartyRenderer;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->active()
            ->where('stock', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts'));
    }

    public function about(SmartyRenderer $smarty): View
    {
        return view('smarty.about', [
            'html' => $smarty->render('about.tpl', [
                'appName' => config('app.name'),
                'year' => now()->year,
                'productsUrl' => route('products.index'),
            ]),
        ]);
    }
}
