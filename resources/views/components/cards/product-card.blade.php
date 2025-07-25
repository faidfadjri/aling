<a href="{{ route('product.detail', $product->id) }}" wire:navigate
    class="bg-white hover:bg-gray-100 duration-200 cursor-pointer rounded-xl overflow-hidden block relative">

    {{-- Badge diskon --}}
    @if ($product->discount)
        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow z-10">
            -{{ $product->discount }}%
        </div>
    @endif

    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover">

    <div class="p-3 space-y-1">
        <h3 class="text-sm font-semibold text-gray-900 leading-snug truncate">
            {{ $product->name }}
        </h3>

        <p class="text-sm text-black font-bold">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        <div class="flex items-center text-xs text-gray-600 gap-1">
            @if ($product->reviews->isNotEmpty())
                <span>⭐ {{ number_format($product->reviews->average('rating'), 1) }}</span>
                <span>•</span>
            @endif
            <span>{{ $product->orders->count() ?? 0 }} terjual</span>
        </div>

        <div class="text-xs text-gray-500 truncate">
            {{ $product->outlet->name ?? '-' }}
        </div>
    </div>
</a>
