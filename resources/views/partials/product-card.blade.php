<article class="overflow-hidden rounded-lg border border-zinc-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <a href="{{ route('products.show', $product) }}" class="block">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full object-cover">
    </a>
    <div class="space-y-4 p-4">
        <div class="space-y-1">
            <div class="flex items-start justify-between gap-3">
                <h3 class="text-base font-bold leading-6 text-zinc-950">
                    <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                </h3>
                <span class="whitespace-nowrap text-sm font-black text-emerald-700">₦{{ number_format($product->price, 2) }}</span>
            </div>
            <p class="line-clamp-2 text-sm leading-6 text-zinc-600">{{ $product->description }}</p>
        </div>

        <div class="flex items-center justify-between gap-3">
            <span class="text-xs font-semibold text-zinc-500">{{ $product->stock }} in stock</span>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button @disabled($product->stock < 1) class="rounded-md bg-zinc-950 px-3 py-2 text-sm font-bold text-white hover:bg-zinc-800 disabled:cursor-not-allowed disabled:bg-zinc-300" type="submit">
                    Add
                </button>
            </form>
        </div>
    </div>
</article>
