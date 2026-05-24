@extends('layouts.app', ['title' => 'Checkout'])

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-black tracking-tight text-zinc-950">Checkout</h1>
        <p class="mt-2 text-sm text-zinc-600">Complete your delivery details and place the order.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <form action="{{ route('checkout.store') }}" method="POST" class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="full_name">Full name</label>
                    <input id="full_name" name="full_name" value="{{ old('full_name', $user->name) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="phone">Phone number</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="city">City/state</label>
                    <input id="city" name="city" value="{{ old('city') }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-bold text-zinc-800" for="delivery_address">Delivery address</label>
                    <textarea id="delivery_address" name="delivery_address" rows="4" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('delivery_address') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-bold text-zinc-800" for="payment_method">Payment method</label>
                    <select id="payment_method" name="payment_method" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        <option value="Cash on Delivery" @selected(old('payment_method') === 'Cash on Delivery')>Cash on Delivery</option>
                        <option value="Bank Transfer" @selected(old('payment_method') === 'Bank Transfer')>Bank Transfer</option>
                    </select>
                </div>
            </div>
            <button class="mt-6 w-full rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700" type="submit">Place order</button>
        </form>

        <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-black text-zinc-950">Order Summary</h2>
            <div class="mt-4 space-y-4">
                @foreach($items as $item)
                    <div class="flex gap-3">
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-16 w-16 rounded-md object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-bold text-zinc-900">{{ $item['name'] }}</p>
                            <p class="text-xs text-zinc-500">Qty {{ $item['quantity'] }}</p>
                        </div>
                        <span class="text-sm font-bold text-zinc-950">₦{{ number_format($item['line_total'], 2) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-5 flex justify-between border-t border-zinc-100 pt-4 text-base">
                <span class="font-black">Total</span>
                <span class="font-black text-emerald-700">₦{{ number_format($subtotal, 2) }}</span>
            </div>
        </aside>
    </div>
@endsection
