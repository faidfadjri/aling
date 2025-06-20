<div
    class="shadow-md rounded-lg p-4 bg-white hover:bg-gray-100 transition-colors cursor-pointer
        flex flex-col items-start justify-between gap-3 w-[160px] sm:w-[200px] md:w-[220px] lg:w-[250px]">
    <img src="{{ $productImage }}" alt="{{ $productName }}" class="w-full h-24 md:h-28 lg:h-32 object-contain mb-1" />
    <div class="text-sm md:text-base lg:text-lg font-semibold text-gray-800 leading-tight">{{ $productName }}</div>
    <div class="text-sm md:text-md lg:text-lg font-bold text-black">{{ $productPrice }}</div>
    <div class="text-xs md:text-sm text-gray-500">{{ $productOutlet }}</div>
</div>
