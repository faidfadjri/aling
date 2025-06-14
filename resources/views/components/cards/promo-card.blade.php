 <div
     class="shadow-md rounded-sm {{ $index == 0 ? 'min-w-[170px] max-w-[170px] min-h-[230px] max-h-[230px]' : 'min-w-[160px] max-w-[160px] min-h-[220px] max-h-[220px]' }} p-3 hover:bg-gray-100 transition-colors cursor-pointer flex flex-col items-start justify-center gap-1 bg-white">
     <div class="text-xs bg-orange-500 text-white px-2 py-1 rounded mb-2 w-fit">{{ $promoDisc }}</div>
     <img src="{{ $promoImage }}" alt="ayam potong" class="w-full h-18 md:h-20 object-contain mb-2">
     <div class="flex flex-col gap-0 mt-1">
         <div class="text-sm font-semibold">{{ $productName }}</div>
         <div class="text-sm text-gray-800">{{ $productPrice }}</div>
         <div class="text-xs text-gray-500 mt-1">{{ $productOutlet }}</div>
     </div>
 </div>
