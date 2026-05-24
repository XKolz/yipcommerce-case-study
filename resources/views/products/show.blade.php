@extends('layouts.app', ['title' => $product->name])

@section('content')
    <div class="grid gap-8 lg:grid-cols-2">
        <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full object-cover">
        </div>
        <div class="space-y-6">
            <div>
                <a href="{{ route('products.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">Back to products</a>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-zinc-950 sm:text-4xl">{{ $product->name }}</h1>
                <p class="mt-3 text-3xl font-black text-emerald-700">₦{{ number_format($product->price, 2) }}</p>
            </div>

            <p class="text-base leading-8 text-zinc-600">{{ $product->description }}</p>

            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <span class="text-sm font-semibold text-zinc-600">Available stock</span>
                    <span class="text-sm font-black text-zinc-950">{{ $product->stock }}</span>
                </div>
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-col gap-3 sm:flex-row">
                    @csrf
                    <input type="number" min="1" max="{{ $product->stock }}" value="1" name="quantity" class="w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 sm:w-28">
                    <button @disabled($product->stock < 1) class="rounded-md bg-emerald-600 px-5 py-3 text-sm font-bold text-white hover:bg-emerald-700 disabled:cursor-not-allowed disabled:bg-zinc-300" type="submit">
                        Add to cart
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <section class="mt-12">
            <h2 class="mb-4 text-xl font-black text-zinc-950">More Products</h2>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($relatedProducts as $related)
                    @include('partials.product-card', ['product' => $related])
                @endforeach
            </div>
        </section>
    @endif
@endsection
