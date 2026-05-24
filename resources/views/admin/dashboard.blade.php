@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-black tracking-tight text-zinc-950">Dashboard</h1>
        <p class="mt-2 text-sm text-zinc-600">Store performance and recent order activity.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-zinc-500">Products</p>
            <p class="mt-2 text-3xl font-black text-zinc-950">{{ $totalProducts }}</p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-zinc-500">Orders</p>
            <p class="mt-2 text-3xl font-black text-zinc-950">{{ $totalOrders }}</p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-zinc-500">Pending</p>
            <p class="mt-2 text-3xl font-black text-amber-700">{{ $pendingOrders }}</p>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-bold text-zinc-500">Revenue</p>
            <p class="mt-2 text-3xl font-black text-emerald-700">₦{{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>

    <section class="mt-8 overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="flex items-center justify-between gap-3 border-b border-zinc-100 px-5 py-4">
            <h2 class="font-black text-zinc-950">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-xs font-bold uppercase tracking-wide text-zinc-500">
                    <tr>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Payment</th>
                        <th class="px-4 py-3">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="px-4 py-4">
                                <a class="font-bold text-emerald-700 hover:text-emerald-800" href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a>
                            </td>
                            <td class="px-4 py-4 text-zinc-600">{{ $order->full_name }}</td>
                            <td class="px-4 py-4"><x-status-badge :status="$order->status" /></td>
                            <td class="px-4 py-4"><x-status-badge :status="$order->payment_status" /></td>
                            <td class="px-4 py-4 font-bold">₦{{ number_format($order->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-8 text-center text-zinc-500" colspan="5">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
