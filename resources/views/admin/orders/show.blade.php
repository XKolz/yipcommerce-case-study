@extends('layouts.admin', ['title' => $order->order_number])

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">Back to orders</a>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-zinc-950">{{ $order->order_number }}</h1>
            <p class="mt-2 text-sm text-zinc-600">Placed {{ $order->created_at->format('M j, Y g:ia') }}</p>
        </div>
        <div class="flex gap-2">
            <x-status-badge :status="$order->status" />
            <x-status-badge :status="$order->payment_status" />
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <div class="space-y-6">
            <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
                <div class="border-b border-zinc-100 px-5 py-4">
                    <h2 class="font-black text-zinc-950">Order Items</h2>
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

            <div class="grid gap-4 sm:grid-cols-2">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    @csrf
                    @method('PATCH')
                    <label class="text-sm font-bold text-zinc-800" for="status">Order status</label>
                    <select id="status" name="status" class="mt-2 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        @foreach(\App\Models\Order::STATUSES as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button class="mt-3 w-full rounded-md bg-zinc-950 px-4 py-3 text-sm font-bold text-white hover:bg-zinc-800" type="submit">Update status</button>
                </form>

                <form action="{{ route('admin.orders.payment-status', $order) }}" method="POST" class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    @csrf
                    @method('PATCH')
                    <label class="text-sm font-bold text-zinc-800" for="payment_status">Payment status</label>
                    <select id="payment_status" name="payment_status" class="mt-2 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        @foreach(\App\Models\Order::PAYMENT_STATUSES as $status)
                            <option value="{{ $status }}" @selected($order->payment_status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button class="mt-3 w-full rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700" type="submit">Update payment</button>
                </form>
            </div>
        </div>

        <aside class="h-fit rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <h2 class="font-black text-zinc-950">Customer</h2>
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
            <div class="mt-5 space-y-2 border-t border-zinc-100 pt-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-zinc-600">Subtotal</span>
                    <span class="font-bold">₦{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-base">
                    <span class="font-black">Total</span>
                    <span class="font-black text-emerald-700">₦{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </aside>
    </div>
@endsection
