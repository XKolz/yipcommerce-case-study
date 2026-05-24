@extends('layouts.app', ['title' => 'My Orders'])

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-black tracking-tight text-zinc-950">My Orders</h1>
        <p class="mt-2 text-sm text-zinc-600">Review order status, payment status, and order details.</p>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        @if($orders->isEmpty())
            <div class="p-10 text-center">
                <h2 class="text-lg font-black text-zinc-950">No orders yet</h2>
                <a href="{{ route('products.index') }}" class="mt-5 inline-flex rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">Shop products</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 text-sm">
                    <thead class="bg-zinc-50 text-left text-xs font-bold uppercase tracking-wide text-zinc-500">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Items</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Payment</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-4 font-bold text-zinc-950">{{ $order->order_number }}</td>
                                <td class="px-4 py-4 text-zinc-600">{{ $order->items_count }}</td>
                                <td class="px-4 py-4"><x-status-badge :status="$order->status" /></td>
                                <td class="px-4 py-4"><x-status-badge :status="$order->payment_status" /></td>
                                <td class="px-4 py-4 font-bold">₦{{ number_format($order->total, 2) }}</td>
                                <td class="px-4 py-4 text-right">
                                    <a class="font-bold text-emerald-700 hover:text-emerald-800" href="{{ route('orders.show', $order) }}">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
