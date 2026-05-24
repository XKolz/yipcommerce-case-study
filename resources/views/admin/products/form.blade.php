@extends('layouts.admin', ['title' => $product->exists ? 'Edit Product' : 'Create Product'])

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-emerald-700 hover:text-emerald-800">Back to products</a>
        <h1 class="mt-2 text-3xl font-black tracking-tight text-zinc-950">{{ $product->exists ? 'Edit Product' : 'Create Product' }}</h1>
    </div>

    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        @csrf
        @if($product->exists)
            @method('PATCH')
        @endif

        <div class="grid gap-5 lg:grid-cols-[1fr_300px]">
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="name">Name</label>
                    <input id="name" name="name" value="{{ old('name', $product->name) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="description">Description</label>
                    <textarea id="description" name="description" rows="7" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="price">Price</label>
                    <input id="price" type="number" min="0.01" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="stock">Stock</label>
                    <input id="stock" type="number" min="0" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="status">Status</label>
                    <select id="status" name="status" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-bold text-zinc-800" for="image">Image</label>
                    <input id="image" type="file" name="image" class="mt-1 w-full rounded-md border border-zinc-300 bg-white px-3 py-3 text-sm">
                </div>
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full rounded-md object-cover">
                @endif
            </div>
        </div>

        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.products.index') }}" class="rounded-md border border-zinc-300 px-4 py-3 text-center text-sm font-bold text-zinc-800 hover:bg-zinc-100">Cancel</a>
            <button class="rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700" type="submit">{{ $product->exists ? 'Save changes' : 'Create product' }}</button>
        </div>
    </form>
@endsection
