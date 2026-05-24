@extends('layouts.app', ['title' => $order->order_number])

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('orders.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">Back to orders</a>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-zinc-950">{{ $order->order_number }}</h1>
        </div>
        <div class="flex gap-2">
            <x-status-badge :status="$order->status" />
            <x-status-badge :status="$order->payment_status" />
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
            <div class="border-b border-zinc-100 px-5 py-4">
                <h2 class="font-black text-zinc-950">Items</h2>
            </div>
            <div class="divide-y divide-zinc-100">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 p-5">
                        <img src="{{ $item->product?->image_url ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=300&q=80' }}" alt="{{ $item->product_name }}" class="h-16 w-16 rounded-md object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-zinc-950">{{ $item->product_name }}</p>
                            <p class="text-sm text-zinc-500">₦{{ number_format($item->unit_price, 2) }} × {{ $item->quantity }}</p>
                        </div>
                        <span class="font-black">₦{{ number_format($item->total, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <h2 class="font-black text-zinc-950">Delivery</h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div>
                    <dt class="font-bold text-zinc-700">Name</dt>
                    <dd class="mt-1 text-zinc-600">{{ $order->full_name }}</dd>
                </div>
                <div>
                    <dt class="font-bold text-zinc-700">Contact</dt>
                    <dd class="mt-1 text-zinc-600">{{ $order->email }} · {{ $order->phone }}</dd>
                </div>
                <div>
                    <dt class="font-bold text-zinc-700">Address</dt>
                    <dd class="mt-1 text-zinc-600">{{ $order->delivery_address }}, {{ $order->city }}</dd>
                </div>
                <div>
                    <dt class="font-bold text-zinc-700">Payment method</dt>
                    <dd class="mt-1 text-zinc-600">{{ $order->payment_method }}</dd>
                </div>
            </dl>
            <div class="mt-5 flex justify-between border-t border-zinc-100 pt-4">
                <span class="font-black">Total</span>
                <span class="font-black text-emerald-700">₦{{ number_format($order->total, 2) }}</span>
            </div>
        </aside>
    </div>
@endsection
