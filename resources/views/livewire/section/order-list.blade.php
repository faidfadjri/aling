<div class="bg-[#F5FBFF] min-h-screen">
    {{-- Header --}}
    <div class="sticky top-0 z-50 bg-white shadow-md">
        <div class="bg-[#F5FBFF] p-4 flex items-center">
            <div class="flex flex-1 items-center bg-white border border-gray-500 rounded-md px-3 py-2">
                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                </svg>
                <input type="text" placeholder="Cari transaksi" id="searchbar"
                    class="bg-transparent outline-none w-full text-sm text-gray-700 placeholder-gray-400"
                    autocomplete="off" wire:model.live="search" />
            </div>
            <div class="cart relative ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <span
                    class="absolute -top-1 -right-1 h-3 w-3 flex items-center justify-center rounded-full bg-orange-400 text-white text-xs font-bold ring-2 ring-white">
                    2
                </span>
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

        <div wire:loading class="w-full space-y-4">
            @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-xl p-4 shadow-sm animate-pulse space-y-3"
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
        </div>


        <div class="flex flex-col gap-2" wire:loading.remove>
            @for ($i = 0; $i < 3; $i++)
                <livewire:components.order-card :order="$order" :wire:key="'order-' . $i" />
            @endfor
        </div>
    </div>
</div>
