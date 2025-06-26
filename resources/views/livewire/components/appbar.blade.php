<div class="sticky top-0 z-50 bg-white shadow-md">
    <div class="bg-[#F5FBFF] p-4 flex items-center sticky top-0 z-50">
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
                        <p class="text-lg font-semibold text-gray-800">{{ $title }}</p>
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
                            autocomplete="off" wire:model.live="search" />
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
                                        <a href="{{ route('product', ['search' => $result->name]) }}" wire:navigate
                                            class="flex items-center space-x-2 text-gray-700 py-2 px-3 rounded-md cursor-pointer hover:bg-gray-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                                            </svg>

                                            <span
                                                class="text-sm lg:text-md py-1 font-medium text-gray-800">{{ $result->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="mb-6">
                                    <h2 class="font-semibold text-gray-800 mb-3">Pencarian Terakhir</h2>
                                    <div id="history-container" class="flex flex-wrap gap-2">
                                        @foreach ($searchHistory as $history)
                                            <button wire:click="$set('search', '{{ $history }}')"
                                                class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-800 rounded-full text-sm">
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
                <div class="flex items-center gap-3 px-2">
                    <a href="https://wa.me/+{{ env('WHATSAPP') }}" class="flex items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            class="size-6 text-green-500">
                            <path
                                d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.17 1.6 5.98L0 24l6.19-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.66-.5-5.23-1.44l-.37-.22-3.68.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.27-7.73c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.34.21-.63.07-.29-.14-1.22-.45-2.33-1.43-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.59.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.07-.14-.64-1.54-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.36-.01-.56-.01-.19 0-.5.07-.76.36-.26.29-1 1-.99 2.43.01 1.43 1.03 2.81 1.18 3 .14.19 2.03 3.1 4.93 4.22.69.3 1.23.48 1.65.61.69.22 1.32.19 1.81.12.55-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.19-.55-.33z" />
                        </svg>
                    </a>
                    <a href="{{ route('order.cart') }}" class="cart relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-1 -right-1 h-3 w-3 flex items-center justify-center rounded-full bg-orange-400 text-white text-xs font-bold ring-2 ring-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('order') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
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

                            Login
                        </a>
                    @endif
                </div>
            @else
                <button class="font-semibold ml-2 cursor-pointer" wire:click="disableFocus">Batal</button>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const menu = document.getElementById('dropdown-menu');
        const button = document.querySelector('#user-menu > button');

        function toggleMenu() {
            menu.classList.toggle('opacity-0');
            menu.classList.toggle('scale-95');
            menu.classList.toggle('pointer-events-none');
        }

        document.addEventListener('click', function(e) {
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            }
        });

        document.getElementById('searchbar').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                mySearchFunction();
            }
        });

        function mySearchFunction() {
            const searchValue = document.getElementById('searchbar').value;
            if (searchValue.trim() !== '') {
                window.location.href = `/product?search=${encodeURIComponent(searchValue)}`;
            }
        }
    </script>
@endpush
