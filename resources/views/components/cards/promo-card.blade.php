<div class="swiper-slide w-auto">
    <div
        class="shadow-md rounded-lg p-4 bg-white hover:bg-gray-100 transition-colors cursor-pointer
        flex flex-col items-start justify-between gap-3 w-[160px] sm:w-[200px] md:w-[220px] lg:w-[250px]">

        <div class="text-xs lg:text-sm bg-red font-semibold text-white px-2 py-1 rounded w-fit">
            {{ $promo->discount }}%
        </div>

        <img src="{{ $promo->image }}" alt="{{ $promo->name }}" class="w-full h-24 md:h-28 lg:h-32 object-contain mb-1" />
        <div class="flex flex-col w-full gap-2">
            <div class="text-sm md:text-base lg:text-lg font-semibold text-gray-800 leading-tight">
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
</div>
