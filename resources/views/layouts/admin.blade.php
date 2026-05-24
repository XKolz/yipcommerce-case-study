<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' | Admin | ' : 'Admin | ' }}{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-100 text-zinc-950 antialiased">
    <div class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-black tracking-tight">YipCommerce Admin</a>
            <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-zinc-700">
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('admin.products.index') }}">Products</a>
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('admin.orders.index') }}">Orders</a>
                <a class="rounded-md px-3 py-2 hover:bg-zinc-100" href="{{ route('home') }}">Storefront</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="rounded-md bg-zinc-950 px-3 py-2 text-white hover:bg-zinc-800" type="submit">Logout</button>
                </form>
            </nav>
        </div>
    </div>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('partials.flash')
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
