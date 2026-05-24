@extends('layouts.app', ['title' => 'Cart'])

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-zinc-950">Shopping Cart</h1>
            <p class="mt-2 text-sm text-zinc-600">{{ $totalQuantity }} item(s) in your cart.</p>
        </div>
        @if($items->isNotEmpty())
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-bold text-zinc-700 hover:bg-zinc-100" type="submit">Clear cart</button>
            </form>
        @endif
    </div>

    @if($items->isEmpty())
        <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-10 text-center">
            <h2 class="text-lg font-black text-zinc-950">Your cart is empty</h2>
            <a href="{{ route('products.index') }}" class="mt-5 inline-flex rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">Shop products</a>
        </div>
    @else
        <div class="grid gap-6 lg:grid-cols-[1fr_340px]">
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-32 w-full rounded-md object-cover sm:w-40">
                            <div class="flex flex-1 flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h2 class="font-black text-zinc-950">{{ $item['name'] }}</h2>
                                    <p class="mt-1 text-sm text-zinc-600">₦{{ number_format($item['price'], 2) }} each</p>
                                    <p class="mt-1 text-xs font-semibold text-zinc-500">{{ $item['stock'] }} in stock</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-3">
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" min="1" max="{{ $item['stock'] }}" name="quantity" value="{{ $item['quantity'] }}" class="w-20 rounded-md border border-zinc-300 px-3 py-2 text-sm">
                                        <button class="rounded-md bg-zinc-950 px-3 py-2 text-sm font-bold text-white hover:bg-zinc-800" type="submit">Update</button>
                                    </form>
                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-bold text-red-700 hover:bg-red-50" type="submit">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-zinc-100 pt-4 text-right text-sm font-black text-zinc-950">
                            Line total: ₦{{ number_format($item['line_total'], 2) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-lg font-black text-zinc-950">Summary</h2>
                <div class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-zinc-600">Items</span>
                        <span class="font-bold">{{ $totalQuantity }}</span>
                    </div>
                    <div class="flex justify-between border-t border-zinc-100 pt-3 text-base">
                        <span class="font-black">Total</span>
                        <span class="font-black text-emerald-700">₦{{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout.index') }}" class="mt-5 flex w-full justify-center rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">Checkout</a>
            </aside>
        </div>
    @endif
@endsection
