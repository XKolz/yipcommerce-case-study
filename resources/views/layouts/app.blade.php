<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' | ' : '' }}{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-950 antialiased">
    <div class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="text-lg font-black tracking-tight text-zinc-950">
                YipCommerce
            </a>

            <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-zinc-700">
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('products.index') }}">Products</a>
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('about') }}">About</a>
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('cart.index') }}">
                    Cart
                    <span class="ml-1 rounded-full bg-emerald-100 px-2 py-0.5 text-xs text-emerald-800">
                        {{ app(\App\Services\CartService::class)->totalQuantity() }}
                    </span>
                </a>
                @auth
                    <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('orders.index') }}">Orders</a>
                    @if(auth()->user()->isAdmin())
                        <a class="rounded-md bg-zinc-950 px-3 py-2 text-white hover:bg-zinc-800" href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="rounded-md px-3 py-2 hover:bg-zinc-100" type="submit">Logout</button>
                    </form>
                @else
                    <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('login') }}">Login</a>
                    <a class="rounded-md bg-emerald-600 px-3 py-2 text-white hover:bg-emerald-700" href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>
    </div>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('partials.flash')
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-sm text-zinc-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <span>&copy; {{ date('Y') }} YipCommerce Case Study</span>
            <span>Laravel 12, Blade, Tailwind, Eloquent, Smarty</span>
        </div>
    </footer>
</body>
</html>
