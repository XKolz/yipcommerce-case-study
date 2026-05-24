@extends('layouts.admin', ['title' => 'Products'])

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-zinc-950">Products</h1>
            <p class="mt-2 text-sm text-zinc-600">Create, edit, and retire storefront products.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">New product</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-xs font-bold uppercase tracking-wide text-zinc-500">
                    <tr>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-md object-cover">
                                    <div>
                                        <p class="font-bold text-zinc-950">{{ $product->name }}</p>
                                        <p class="text-xs text-zinc-500">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 font-bold">₦{{ number_format($product->price, 2) }}</td>
                            <td class="px-4 py-4 text-zinc-600">{{ $product->stock }}</td>
                            <td class="px-4 py-4"><x-status-badge :status="$product->status" /></td>
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-bold hover:bg-zinc-100">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-bold text-red-700 hover:bg-red-50" type="submit">Inactive</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-10 text-center text-zinc-500" colspan="5">No products have been created.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
@endsection
