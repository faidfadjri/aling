<div class="sticky top-0 z-50 bg-white shadow-md">
    <div class="bg-[#F5FBFF] px-4 py-2 lg:p-4 flex items-center sticky top-0 z-50">
        <div class="flex items-center justify-between w-full gap-2 lg:gap-3">
            @if ((isset($back) && $back) || (isset($title) && $title))
                <div class="flex items-center gap-5">
                    @if (isset($back) && $back)
                        <a href="{{ $back }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </a>
                    @endif
                    @if (isset($title) && $title)
                        <p class="text-md md:text-xl lg:text-lg font-semibold text-gray-800">{{ $title }}</p>
                    @endif
                </div>
            @endif

            @if (!isset($title) || !$title)
                <a href="/" class="hidden lg:flex items-center gap-3 lg:me-5">
                    <img src="/assets/images/logo.png" alt="logo-brand" class="h-10">
                </a>

                <div class="relative flex-1">
                    <div class="flex items-center bg-white border border-gray-500 rounded-md px-3 py-2">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                        </svg>
                        <input type="text" placeholder="Cari di Aling" id="searchbar"
                            class="bg-transparent outline-none w-full text-sm lg:text-md text-black placeholder-gray-400"
                            autocomplete="off" wire:model.live="search" wire:key="search-input"
                            wire:keydown.enter="onEnter" />
                    </div>

                    <div class="absolute left-0 right-0 w-full z-40 bg-white shadow-xl rounded-b-md">
                        <div class="w-full flex justify-center items-center p-4" wire:loading wire:target='search'>
                            <dotlottie-player src="/assets/lotties/loading.lottie" background="transparent"
                                speed="1" style="width: 35px; height: 35px;" class="mx-auto" loop
                                autoplay></dotlottie-player>
                        </div>

                        @if ($isFocused)
                            <div class="p-4">
                                <div class="mb-10">
                                    @foreach ($results as $result)
                                        <a href="@if ($searchOrder) {{ route('order', ['search' => $result->order_number]) }}
                                            @else 
                                            {{ route('product', ['search' => $result->name]) }} @endif"
                                            class="flex items-center space-x-2 text-gray-700 py-2 px-3 rounded-md cursor-pointer hover:bg-gray-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                                            </svg>

                                            <span class="text-sm lg:text-md py-1 font-medium text-gray-800">
                                                @if ($searchOrder)
                                                    {{ $result->order_number }}
                                                @else
                                                    {{ $result->name }}
                                                @endif
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="mb-6">
                                    <h2 class="font-semibold text-gray-800 mb-3">Pencarian Terakhir</h2>
                                    <div id="history-container" class="flex flex-wrap gap-2">
                                        @foreach ($searchHistory as $history)
                                            <a href="{{ route('product', ['search' => $history]) }}"
                                                class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-800 rounded-full text-sm hover:bg-gray-50 duration-200 cursor-pointer">
                                                {{ $history }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div>
                                    <h2 class="font-semibold text-gray-800 flex items-center gap-2 mb-3">
                                        <span>👍</span> Best Seller
                                    </h2>
                                    <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm w-full mb-4">
                                        <img src="https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg"
                                            alt="Ayam Kampung" class="w-10 h-10 rounded-full object-cover" />
                                        <span class="text-sm font-medium text-gray-800">Ayam Kampung 10KG</span>
                                    </div>
                                </div> --}}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if (!$isFocused)
                <div class="flex gap-1">
                    <div class="flex items-center gap-3 px-2">
                        <a href="https://wa.me/+{{ env('WHATSAPP') }}" class="flex items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                        </a>
                        <a href="{{ route('order.cart') }}" wire:navigate class="cart relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            @if ($cartCount > 0)
                                <span wire:key="cart-count"
                                    class="absolute -top-1 -right-1 h-4 w-4 flex items-center justify-center rounded-full bg-blue-400 text-white text-xs font-bold ring-2 ring-white">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>

                    <div class="hidden lg:flex items-center gap-2">
                        <a href="{{ route('order') }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </a>

                        <div class="h-6 w-px bg-gray-300 mx-2"></div>

                        @if (Auth::check())
                            <div class="relative group" id="user-menu">
                                <button type="button" class="flex items-center gap-2 focus:outline-none"
                                    onclick="toggleMenu()">
                                    <span
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-base">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                    {{ \Illuminate\Support\Str::limit(Auth::user()->name, 10) }}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>

                                <div id="dropdown-menu"
                                    class="absolute rounded-md overflow-hidden right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-50 opacity-0 scale-95 pointer-events-none transition-all duration-200 ease-out">
                                    <a href="#"
                                        class="block px-4 py-2 flex items-center gap-2 text-gray-700 hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        Profile
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        class="w-full text-left px-4 py-2 flex items-center gap-2 text-white bg-rose-700 hover:bg-rose-800 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-sm font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>

                                Masuk/Daftar
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <button class="font-semibold ml-2 cursor-pointer" wire:click="disableFocus">Batal</button>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script>
        if (!window.__appbarMenuInitialized) {
            window.__appbarMenuInitialized = true;

            document.addEventListener('click', function(e) {
                const menu = document.getElementById('dropdown-menu');
                const button = document.querySelector('#user-menu > button');

                if (menu && button && !button.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });

            window.toggleMenu = function() {
                const menu = document.getElementById('dropdown-menu');
                if (menu) {
                    menu.classList.toggle('opacity-0');
                    menu.classList.toggle('scale-95');
                    menu.classList.toggle('pointer-events-none');
                }
            };
        }
    </script>
@endpush
