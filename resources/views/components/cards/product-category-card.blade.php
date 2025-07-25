<a href="{{ route('product.detail', $product->id) }}"
    class="shadow-md rounded-lg p-4 bg-white hover:bg-gray-100 transition-colors cursor-pointer
        flex flex-col items-start justify-between w-[160px] sm:w-[200px] md:w-[220px] lg:w-[250px] h-60 lg:h-70">
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
        class="w-full h-24 md:h-28 lg:h-32 object-cover mb-1 rounded-md" />

    <div class="flex flex-col gap-2">
        <div class="text-sm md:text-base lg:text-lg font-medium text-gray-800 leading-tight">{{ $product->name }}</div>
        <div class="text-sm md:text-md lg:text-xl font-bold text-black">
            {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
        </div>
    </div>
    <p class="text-xs md:text-sm text-gray-500">{{ $product->name }}</p>
</a>
