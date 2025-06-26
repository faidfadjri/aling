<div class="bg-[#F5FBFF] min-h-screen">
    {{-- Header --}}
    <div class="sticky top-0 z-50 bg-white shadow-md">
        <div class="bg-[#F5FBFF] p-4 flex items-center gap-4">
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="flex flex-1 items-center bg-white border border-gray-500 rounded-md px-3 py-2">
                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                </svg>
                <input type="text" placeholder="Cari transaksi" id="searchbar"
                    class="bg-transparent outline-none w-full text-sm text-gray-700 placeholder-gray-400"
                    autocomplete="off" wire:model.live="search" />
            </div>
            <div class="hidden lg:flex gap-10">
                <div class="flex items-center gap-3 px-2">
                    <a href="https://wa.me/+{{ env('WHATSAPP') }}" class="flex items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            class="size-6 text-green-500">
                            <path
                                d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.17 1.6 5.98L0 24l6.19-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.66-.5-5.23-1.44l-.37-.22-3.68.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.27-7.73c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.34.21-.63.07-.29-.14-1.22-.45-2.33-1.43-.86-.77-1.44-1.72-1.61-2.01-.17-.29-.02-.45.13-.59.13-.13.29-.34.43-.51.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.07-.14-.64-1.54-.88-2.12-.23-.56-.47-.48-.64-.49-.17-.01-.36-.01-.56-.01-.19 0-.5.07-.76.36-.26.29-1 1-.99 2.43.01 1.43 1.03 2.81 1.18 3 .14.19 2.03 3.1 4.93 4.22.69.3 1.23.48 1.65.61.69.22 1.32.19 1.81.12.55-.08 1.7-.7 1.94-1.38.24-.68.24-1.26.17-1.38-.07-.12-.26-.19-.55-.33z" />
                        </svg>
                    </a>
                    <a class="cart relative cursor-pointer" href="{{ route('order.cart') }}">
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
                <div class="flex items-center gap-2">
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
            </div>
        </div>
    </div>

    <div class="px-4 pt-2 pb-28">
        <div class="relative flex gap-2 overflow-x-auto mb-4">
            <div class="flex gap-2 overflow-x-auto scrollbar-hide snap-x snap-mandatory w-full">
                @foreach (['Semua', 'Dipesan', 'Diproses', 'Pengiriman', 'Tiba di Tujuan'] as $index => $status)
                    <button wire:click="selectStatus('{{ $status }}')"
                        class="flex-shrink-0 px-4 py-2 text-sm rounded-full shadow-sm snap-start
                        {{ $selectedstatus === $status ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}"
                        wire:key="order-{{ $index }}">
                        {{ $status }}
                    </button>
                @endforeach
            </div>
            <style>
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
            <button
                class="sticky right-0 px-3 py-2 bg-white rounded-full shadow-md z-10 flex items-center justify-center">
                <svg wire:loading class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </button>
        </div>

        <div class="flex flex-col gap-3">
            @for ($i = 0; $i < 3; $i++)
                <div wire:loading class="bg-white rounded-xl p-4 shadow-sm animate-pulse space-y-3 w-full"
                    wire:key="skeleton-{{ $i }}">
                    <div class="flex justify-between items-center">
                        <div class="h-4 bg-gray-200 rounded w-32"></div>
                        <div class="h-4 bg-gray-200 rounded w-20"></div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-xl"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                            <div class="h-4 bg-gray-200 rounded w-2/5 mt-2"></div>
                            <div class="h-5 bg-gray-200 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="h-9 bg-gray-200 rounded w-32 ml-auto"></div>
                </div>
            @endfor


            @foreach ($orders as $index => $order)
                <div wire:loading.remove>
                    <livewire:components.order-card :order="$order" :wire:key="'order-' . $index" />
                </div>
            @endforeach
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
    </script>
@endpush
