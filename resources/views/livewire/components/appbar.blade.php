<div>
    <div class="bg-[#F5FBFF] p-4 sticky top-0 z-50 flex items-center">
        <div class="flex items-center justify-between gap-2 w-full">
            <div class="flex items-center gap-5">
                @if (isset($backButton) && $backButton)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                @endif
                @if (isset($title) && $title)
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $title }}
                    </p>
                @endif
            </div>

            @if (!isset($title) || !$title)
                <div class="flex items-center flex-1 bg-white border border-gray-500 rounded-md px-3 py-2">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                    </svg>
                    <input type="text" placeholder="Cari di Aling" id="searchbar"
                        class="bg-transparent outline-none w-full text-sm text-gray-700 placeholder-gray-400"
                        autocomplete="off" wire:model.live="search" />
                </div>
            @endif

            @if (!$isFocused)
                <div class="relative ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 flex items-center justify-center h-3 w-3 rounded-full bg-orange-400 text-white text-xs font-bold ring-2 ring-white">
                        2
                    </span>
                </div>
            @endif

            @if ($isFocused)
                <a href="/" class="font-semibold ml-2">Batal</a>
            @endif

        </div>
    </div>



    <div>
        <div class="w-full flex flex-col items-center justify-center" wire:loading>
            <dotlottie-player src="/assets/lotties/loading.lottie" background="transparent" speed="1"
                style="width: 35px; height: 35px; display: flex; margin: auto;" loop autoplay></dotlottie-player>
        </div>
        @if ($isFocused)
            <div class="p-4 bg-white shadow-xl rounded-xl mx-5 mb-4">
                <div class="mb-6">
                    <h2 class="font-semibold text-gray-800 mb-3">Pencarian Terakhir</h2>
                    <div id="history-container" class="flex flex-wrap gap-2">
                        <button
                            class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                            5KG</button>
                        <button
                            class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                            Kampung</button>
                        <button
                            class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                            Boiler</button>
                    </div>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-800 flex items-center gap-2 mb-3">
                        <span>👍</span> Best Seller
                    </h2>

                    <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm w-full mb-4">
                        <img src="https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg"
                            alt="Ayam Kampung" class="w-10 h-10 rounded-full object-cover" />
                        <span class="text-sm font-medium text-gray-800">Ayam Kampung 10KG</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
