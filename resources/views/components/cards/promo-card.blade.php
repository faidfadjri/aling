<a href="{{ route('product.detail', $promo->id) }}" class="swiper-slide w-auto">
    <div
        class="shadow-md rounded-lg p-4 bg-white hover:bg-gray-200 hover:shadow-xl transition-colors cursor-pointer
    flex flex-col items-start justify-between w-[160px] sm:w-[200px] md:w-[220px] lg:w-[220px] h-70">

        <div class="flex items-center justify-center w-full relative">
            <img src="{{ $promo->image }}" alt="{{ $promo->name }}"
                class="w-full h-24 md:h-28 lg:w-full lg:h-35 object-cover mb-1 rounded-sm" />
            <div
                class="text-xs lg:text-sm bg-red font-semibold text-white px-2 py-1 rounded w-fit absolute right-1 top-1">
                {{ $promo->discount }}%
            </div>
        </div>

        <div class="flex flex-col w-full gap-2 min-h-[72px]">
            <div class="text-sm md:text-base lg:text-lg font-semibold text-gray-800 leading-tight line-clamp-2">
                {{ $promo->name }}
            </div>
            <div class="text-sm md:text-md lg:text-lg font-bold text-black">
                {{ 'Rp ' . number_format($promo->price, 0, ',', '.') }}
            </div>
        </div>

        <div class="text-xs md:text-sm text-gray-500">
            {{ $promo->outlet->name }}
        </div>
    </div>
</a>
