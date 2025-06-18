<a class="bg-white hover:bg-gray-100 duration-200 cursor-pointer rounded-xl shadow-sm overflow-hidden"
    href="{{ route('product.detail', $productId) }}">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-28 object-cover">
    <div class="p-3 space-y-1">
        <h3 class="text-sm font-medium text-gray-900 leading-tight">{{ $title }}</h3>
        <p class="text-sm text-black font-bold">Rp. {{ number_format($price, 0, ',', '.') }}</p>
        <div class="flex items-center text-xs text-gray-600 gap-1">
            ⭐ <span>{{ $rating }}</span> • <span>{{ $sold }} terjual</span>
        </div>
        <div class="text-xs text-gray-500">{{ $outlet }}</div>
    </div>
</a>
