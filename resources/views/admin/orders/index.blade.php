@extends('layouts.admin', ['title' => 'Orders'])

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-black tracking-tight text-zinc-950">Orders</h1>
        <p class="mt-2 text-sm text-zinc-600">Review customer orders and update fulfillment/payment state.</p>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-xs font-bold uppercase tracking-wide text-zinc-500">
                    <tr>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Payment</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-4 py-4 font-bold text-zinc-950">{{ $order->order_number }}</td>
                            <td class="px-4 py-4">
                                <p class="font-bold text-zinc-900">{{ $order->full_name }}</p>
                                <p class="text-xs text-zinc-500">{{ $order->email }}</p>
                            </td>
                            <td class="px-4 py-4"><x-status-badge :status="$order->status" /></td>
                            <td class="px-4 py-4"><x-status-badge :status="$order->payment_status" /></td>
                            <td class="px-4 py-4 font-bold">₦{{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-emerald-700 hover:text-emerald-800">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-10 text-center text-zinc-500" colspan="6">No orders have been placed.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
