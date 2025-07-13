<div class="bg-[#F5FBFF] min-h-screen">
    <div class="px-4 pt-2 pb-28">
        <div class="relative flex gap-2 overflow-x-auto mb-4">
            <div class="flex gap-2 overflow-x-auto scrollbar-hide snap-x snap-mandatory w-full pt-1 pb-4">
                @foreach (['Semua', 'Pending', 'Diproses', 'Selesai', 'Reject'] as $index => $status)
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
                <svg wire:loading wire:target='selectStatus' class="animate-spin h-4 w-4 text-blue-500"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
                <svg wire:loading.remove wire:target='selectStatus' xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </button>
        </div>

        <div class="flex flex-col gap-3">
            @for ($i = 0; $i < 3; $i++)
                <div wire:loading wire:target='loadOrder'
                    class="bg-white rounded-xl p-4 shadow-sm animate-pulse space-y-3 w-full"
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
            @forelse ($items as $index => $item)
                @livewire('components.order-card', ['item' => $item], key('order-' . $item->id))
            @empty
                <div class="text-center text-sm text-gray-500 py-6">Tidak ada pesanan ditemukan.</div>
            @endforelse

            <div class="mt-2">
                @include('components.base.pagination', ['pagination' => $items])
            </div>


            @if ($showModal)
                <div x-data="{ show: true }" x-init="$nextTick(() => show = true)" x-show="show"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40"
                    aria-modal="true" role="dialog">
                    <div x-show="show" @click.away="$wire.closeModal()"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="w-full max-w-lg p-6 bg-white rounded-2xl shadow-2xl border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 mb-5">Beri Rating & Ulasan</h2>

                        <form wire:submit.prevent="saveReview" class="space-y-5">
                            <!-- Rating -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-600">Rating</label>
                                <div class="flex gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" wire:click="$set('rating', {{ $i }})"
                                            class="transition transform hover:scale-110 focus:outline-none"
                                            aria-label="Beri rating {{ $i }}">
                                            <svg class="w-6 h-6 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block mb-1 text-sm font-medium text-gray-600">Ulasan
                                    Anda</label>
                                <textarea wire:model="description" id="description" rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition placeholder:text-sm placeholder:text-gray-400"
                                    placeholder="Ceritakan pengalaman Anda..."></textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-3 pt-2">
                                <button type="button" wire:click="closeModal"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    <span wire:loading.remove wire:target='saveReview'>Kirim</span>
                                    <span wire:loading wire:target='saveReview' class="flex items-center gap-2">
                                        <div
                                            class="animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-yellow-800">
                                        </div>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
    </script>
@endpush
