<div class="bg-[#F5FBFF] min-h-screen">
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


            @foreach ($items as $index => $item)
                <div wire:loading.remove>
                    <livewire:components.order-card :item="$item" :wire:key="'order-' . $index" />
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
