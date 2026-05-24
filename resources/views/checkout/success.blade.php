@extends('layouts.app', ['title' => 'Order Success'])

@section('content')
    <div class="mx-auto max-w-3xl rounded-lg border border-emerald-200 bg-white p-8 text-center shadow-sm">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 text-2xl font-black text-emerald-700">✓</div>
        <h1 class="mt-5 text-3xl font-black tracking-tight text-zinc-950">Order placed</h1>
        <p class="mt-3 text-zinc-600">Your order {{ $order->order_number }} has been created successfully.</p>
        <div class="mt-6 rounded-lg bg-zinc-50 p-5 text-left">
            <div class="flex justify-between gap-4 text-sm">
                <span class="text-zinc-600">Total</span>
                <span class="font-black text-emerald-700">₦{{ number_format($order->total, 2) }}</span>
            </div>
            <div class="mt-3 flex justify-between gap-4 text-sm">
                <span class="text-zinc-600">Payment</span>
                <span class="font-bold">{{ $order->payment_method }}</span>
            </div>
        </div>
        <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
            <a href="{{ route('orders.show', $order) }}" class="rounded-md bg-zinc-950 px-4 py-3 text-sm font-bold text-white hover:bg-zinc-800">View order</a>
            <a href="{{ route('products.index') }}" class="rounded-md border border-zinc-300 px-4 py-3 text-sm font-bold text-zinc-800 hover:bg-zinc-100">Continue shopping</a>
        </div>
    </div>
@endsection
