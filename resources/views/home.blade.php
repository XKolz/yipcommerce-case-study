@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <section class="grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
        <div class="space-y-6">
            <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm sm:p-8">
                <p class="text-sm font-bold uppercase tracking-wide text-emerald-700">YipCommerce Case Study</p>
                <h1 class="mt-3 max-w-3xl text-3xl font-black tracking-tight text-zinc-950 sm:text-5xl">
                    A focused Laravel storefront for everyday products.
                </h1>
                <p class="mt-4 max-w-2xl text-base leading-7 text-zinc-600">
                    Browse a curated product catalog, add items to cart, checkout securely, and manage orders from a clean admin dashboard.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">Shop products</a>
                    <a href="{{ route('login') }}" class="rounded-md border border-zinc-300 px-4 py-3 text-sm font-bold text-zinc-900 hover:bg-zinc-100">Sign in</a>
                </div>
            </div>

            <div>
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-xl font-black text-zinc-950">Featured Products</h2>
                    <a href="{{ route('products.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">View all</a>
                </div>
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($featuredProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @empty
                        <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-8 text-center text-zinc-500 sm:col-span-2 lg:col-span-3">
                            No active products are available yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-base font-black text-zinc-950">Demo Access</h2>
            <div class="mt-4 space-y-4 text-sm">
                <div class="rounded-md bg-zinc-50 p-4">
                    <p class="font-bold text-zinc-900">Admin</p>
                    <p class="mt-1 text-zinc-600">admin@yipdemo.com</p>
                    <p class="text-zinc-600">password</p>
                </div>
                <div class="rounded-md bg-zinc-50 p-4">
                    <p class="font-bold text-zinc-900">Customer</p>
                    <p class="mt-1 text-zinc-600">user@yipdemo.com</p>
                    <p class="text-zinc-600">password</p>
                </div>
            </div>
        </aside>
    </section>
@endsection
