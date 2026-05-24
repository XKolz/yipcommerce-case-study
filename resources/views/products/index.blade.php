@extends('layouts.app', ['title' => 'Products'])

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-zinc-950">Products</h1>
            <p class="mt-2 text-sm text-zinc-600">Search and shop active products in the demo catalog.</p>
        </div>
        <form action="{{ route('products.index') }}" method="GET" class="flex w-full gap-2 sm:max-w-md">
            <input name="search" value="{{ $search }}" placeholder="Search products" class="min-w-0 flex-1 rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
            <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-bold text-white hover:bg-zinc-800" type="submit">Search</button>
        </form>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            @include('partials.product-card', ['product' => $product])
        @empty
            <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-10 text-center text-zinc-500 sm:col-span-2 lg:col-span-3">
                No products matched your search.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection
