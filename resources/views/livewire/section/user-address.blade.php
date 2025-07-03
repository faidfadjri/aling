<div class="p-4" x-data>
    <div class="flex mb-5 h-fit">
        <a href="{{ route('profile.address.add') }}" wire:navigate
            class="w-full bg-blue-600 text-white text-sm font-semibold py-2 lg:py-3 rounded-md text-center">
            + Alamat Baru
        </a>
    </div>

    <div class="flex flex-col gap-3">
        @forelse ($addresses as $address)
            <div wire:click="selectAddress({{ $address->id }})"
                class="cursor-pointer {{ $selectedAddress == $address->id ? 'bg-sky-50 border border-sky-300' : 'bg-white' }} p-4 rounded-md shadow-md flex items-center gap-2 relative transition-all duration-150 hover:ring-1 hover:ring-sky-200">

                @if ($selectedAddress == $address->id)
                    <div class="absolute left-0 top-4 h-10 w-1 rounded-sm bg-sky-400"></div>
                @endif

                <div class="flex-2 w-full">
                    <h2 class="font-semibold text-base capitalize">{{ $address->type }}</h2>
                    <p class="text-sm text-gray-700 mb-5">
                        {{ optional($address->village->district->regency->province)->name ?? '-' }},
                        {{ optional($address->village->district->regency)->name ?? '-' }},
                        {{ optional($address->village->district)->name ?? '-' }},
                        {{ optional($address->village)->name ?? '-' }},
                        {{ $address->description ?? '-' }}
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile.address.edit', ['addressID' => $address->id]) }}"
                            class="flex items-center gap-3 bg-white border border-gray-300 text-sm font-medium py-2 hover:bg-gray-100 duration-200 rounded-md text-center px-4"
                            onclick="event.stopPropagation()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Ubah
                        </a>
                        <button @click.stop="$dispatch('open-confirm', { id: {{ $address->id }} })"
                            class="delete-address-btn flex cursor-pointer items-center gap-2 bg-rose-50 hover:bg-rose-100 duration-200 py-2 px-4 rounded-md text-sm font-medium border border-red-400 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>

                @if ($selectedAddress == $address->id)
                    <div class="text-sky-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                @endif
            </div>
        @empty
            <p class="italic text-center text-gray-500">Belum ada alamat tersimpan.</p>
        @endforelse
    </div>

    <!-- Global Dialog -->
    <div x-data="deleteAddressConfirmDialog()" x-show="show"
        class="fixed inset-0 z-50 flex items-end md:items-center justify-center bg-black/50 bg-opacity-40" x-cloak>

        <div x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-10 scale-95"
            :class="isMobile() ? 'w-full rounded-t-xl bg-white px-6 py-4' : 'bg-white rounded-lg p-6'"
            class="w-full flex flex-col max-w-md mx-auto" @click.outside="show = false">

            <div class="h-2 w-16 mb-3 lg:hidden bg-gray-100 rounded-full self-center"></div>
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Hapus Alamat?</h2>
            <p class="text-sm text-gray-600 mb-4">Alamat ini akan dihapus secara permanen. Lanjutkan?</p>
            <div class="flex items-center gap-2">
                <button
                    class="flex-1 py-2 rounded-md font-semibold bg-rose-50 text-rose-600 hover:bg-rose-200 cursor-pointer duration-200 border border-rose-600"
                    @click="$wire.call('deleteAddress', id); show = false">
                    Hapus
                </button>
                <button
                    class="flex-2 bg-gray-50 text-gray-600 hover:bg-gray-200 duration-200 cursor-pointer border border-gray-600 py-2 rounded-md font-medium"
                    @click="show = false">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <div x-data="addressSnackbar()" x-init="init()" x-show="visible"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
        :class="{
            'bg-teal-100 text-teal-800 border-teal-300': type === 'success',
            'bg-rose-50 text-red-700 border-red-300': type === 'error'
        }"
        class="fixed bottom-4 left-4 z-50 border shadow-md rounded-lg px-4 py-3 text-sm lg:max-w-sm"
        style="display: none;" x-text="message">
    </div>

</div>

@push('scripts')
    <script>
        function deleteAddressConfirmDialog() {
            return {
                show: false,
                id: null,
                init() {
                    window.addEventListener('open-confirm', e => {
                        this.id = e.detail.id;
                        this.show = true;
                    });
                },
                isMobile() {
                    return window.innerWidth < 768;
                }
            };
        }
    </script>

    <script>
        function addressSnackbar() {
            return {
                visible: false,
                message: '',
                timeout: null,
                type: 'success',

                show(msg, type = 'success') {
                    this.message = msg;
                    this.type = type;
                    this.visible = true;

                    if (this.timeout) clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => this.visible = false, 4000);
                },

                init() {
                    window.addEventListener('delete-address-success', (event) => {
                        this.show(event.detail.message || 'Alamat berhasil dihapus', 'success');
                    });

                    window.addEventListener('delete-address-fails', (event) => {
                        this.show(event.detail.error || 'Gagal menghapus alamat', 'error');
                    });
                }
            }
        }
    </script>
@endpush
