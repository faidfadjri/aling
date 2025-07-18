<div class="bg-[#F5FBFF] min-h-screen" id="order-list">
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <div class="px-4 pt-2 pb-28">
        <div class="relative flex items-center gap-2 overflow-x-auto mb-4">
            <div class="flex gap-2 overflow-x-auto scrollbar-hide snap-x snap-mandatory w-full pt-1 pb-4">
                <button wire:click="selectStatus('Semua')"
                    class="flex-shrink-0 px-4 py-2 text-sm rounded-full shadow-sm snap-start
                        {{ $selectedstatus === 'Semua' ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}"
                    wire:key="order-status-0">
                    Semua
                </button>
                @foreach ($orderStatuses as $index => $status)
                    <button wire:click="selectStatus('{{ $status }}')"
                        class="flex-shrink-0 px-4 py-2 text-sm rounded-full shadow-sm snap-start
                        {{ $selectedstatus === $status ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}"
                        wire:key="order-status-{{ $index }}">
                        {{ $status }}
                    </button>
                @endforeach
            </div>
            <button
                class="sticky right-0 px-3 py-2 h-fit bg-white rounded-full shadow-md z-10 flex items-center justify-center">
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
                @livewire('components.order-card', ['item' => $item], key('order-outlet-' . ($item->id ?? uniqid())))
            @empty
                <div class="text-center text-sm text-gray-500 py-6">Tidak ada pesanan ditemukan.</div>
            @endforelse

            <div class="mt-2">
                @include('components.base.pagination', ['pagination' => $items])
            </div>
        </div>

        <div id="ratingModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
            <form method="POST" action="{{ route('order.review.submit') }}"
                class="w-full flex items-center justify-center">
                @csrf
                <div class="bg-white w-[75%] lg:w-96 p-6 rounded-lg shadow-xl relative">

                    <h2 class="text-xl font-semibold mb-4 text-center">Berikan Ulasan</h2>

                    <div class="flex justify-center mb-4 space-x-1" id="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg data-index="{{ $i }}"
                                class="w-8 h-8 cursor-pointer text-gray-300 hover:text-yellow-400" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12 17.3l6.2 3.7-1.6-7 5.4-4.7-7.1-.6L12 2 9.1 8.7l-7.1.6 5.4 4.7-1.6 7z" />
                            </svg>
                        @endfor
                    </div>
                    <input type="hidden" id="activeOrderOutletId" name="activeOrderOutletId"
                        class="p-2 border border-gray-300 rounded-md" placeholder="Order ID" required />
                    <input type="hidden" id="rating" name="rating" class="p-2 border border-gray-300 rounded-md"
                        placeholder="Rating" required />
                    <textarea name="description" placeholder="Tulis ulasan Anda..." rows="4"
                        class="w-full border border-gray-300 rounded-md p-3 mb-4 text-sm focus:outline-none focus:ring focus:border-blue-300 resize-none"
                        required></textarea>

                    <div class="flex justify-end space-x-2">
                        <button id="closeModal" type="button"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-900">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scope = document.getElementById('order-list');
            if (!scope) return;

            const modal = scope.querySelector('#ratingModal');
            const closeModalBtn = scope.querySelector('#closeModal');
            const stars = scope.querySelectorAll('#stars svg');

            let selectedRating = 0;
            let activeOrderOutletId = null;

            closeModalBtn?.addEventListener('click', () => {
                modal.classList.add('hidden');
                Livewire.dispatch('closeModalFromJs');
            });

            modal?.addEventListener('click', (e) => {
                if (e.target === modal) modal.classList.add('hidden');
            });

            stars.forEach((star, index) => {
                star.addEventListener('mouseenter', () => {
                    stars.forEach((s, i) => s.classList.toggle('text-yellow-400', i <= index));
                });

                star.addEventListener('mouseleave', () => {
                    stars.forEach((s, i) => s.classList.toggle('text-yellow-400', i <
                        selectedRating));
                });

                star.addEventListener('click', () => {
                    selectedRating = index + 1;
                    stars.forEach((s, i) => s.classList.toggle('text-yellow-400', i <
                        selectedRating));

                    const input = modal.querySelector('input[name="rating"]');
                    if (input) input.value = selectedRating;
                });
            });

            window.addEventListener('review', function(event) {
                activeOrderOutletId = event.detail;
                modal.classList.remove('hidden');

                const input = modal.querySelector('#activeOrderOutletId');
                if (input) input.value = activeOrderOutletId;

            });
        });
    </script>
@endpush
