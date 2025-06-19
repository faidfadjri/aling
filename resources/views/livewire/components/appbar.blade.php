<div class="sticky top-0 z-50 bg-white shadow-md">
    <div class="bg-[#F5FBFF] p-4 flex items-center sticky top-0 z-50">
        <div class="flex items-center justify-between w-full gap-2 lg:gap-10">

            {{-- Back & Title --}}
            @if ((isset($back) && $back) || (isset($title) && $title))
                <div class="flex items-center gap-5">
                    @if (isset($back) && $back)
                        <a href="{{ $back }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                    @endif
                    @if (isset($title) && $title)
                        <p class="text-lg font-semibold text-gray-800">{{ $title }}</p>
                    @endif
                </div>
            @endif

            @if (!isset($title) || !$title)
                <div class="hidden lg:flex items-center gap-3">
                    <img src="/assets/images/logo.png" alt="logo-brand" class="h-10">
                    <h1 class="text-xl text-blue-900 font-semibold" style="font-family: 'Audiowide', sans-serif">
                        Ayam Keliling
                    </h1>
                </div>

                <div class="relative flex-1">
                    <div class="flex items-center bg-white border border-gray-500 rounded-md px-3 py-2">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                        </svg>
                        <input type="text" placeholder="Cari di Aling" id="searchbar"
                            class="bg-transparent outline-none w-full text-sm text-gray-700 placeholder-gray-400"
                            autocomplete="off" wire:model.live="search" />
                    </div>

                    <div class="absolute left-0 right-0 w-full z-40 bg-white shadow-xl rounded-b-md">
                        <div class="w-full flex justify-center items-center p-4" wire:loading>
                            <dotlottie-player src="/assets/lotties/loading.lottie" background="transparent"
                                speed="1" style="width: 35px; height: 35px;" class="mx-auto" loop
                                autoplay></dotlottie-player>
                        </div>

                        @if ($isFocused)
                            <div class="p-4">
                                <div class="mb-6">
                                    <h2 class="font-semibold text-gray-800 mb-3">Pencarian Terakhir</h2>
                                    <div id="history-container" class="flex flex-wrap gap-2">
                                        @foreach ($searchHistory as $history)
                                            <button wire:click="$set('search', '{{ $history }}')"
                                                class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">
                                                {{ $history }}
                                            </button>
                                        @endforeach
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
            @endif

            @if (!$isFocused)
                @if (!isset($back) && !$back)
                    <div class="flex items-center gap-3 px-2">
                        <button class="flex items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                class="size-6 text-green-500">
                                <path
                                    d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.17 1.6 5.98L0 24l6.19-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.66-.5-5.23-1.44l-.37-.22-3.68.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.27-7.73c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.34.21-.63.07-.29-.14-1.22-.45-2.33-1.43-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.59.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.07-.14-.64-1.54-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.36-.01-.56-.01-.19 0-.5.07-.76.36-.26.29-1 1-.99 2.43.01 1.43 1.03 2.81 1.18 3 .14.19 2.03 3.1 4.93 4.22.69.3 1.23.48 1.65.61.69.22 1.32.19 1.81.12.55-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.19-.55-.33z" />
                            </svg>
                        </button>
                        <a class="cart relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            <span
                                class="absolute -top-1 -right-1 h-3 w-3 flex items-center justify-center rounded-full bg-orange-400 text-white text-xs font-bold ring-2 ring-white">
                                2
                            </span>
                        </a>
                    </div>
                @endif
            @else
                <button class="font-semibold ml-2 cursor-pointer" wire:click="disableFocus">Batal</button>
            @endif

        </div>
    </div>
</div>
