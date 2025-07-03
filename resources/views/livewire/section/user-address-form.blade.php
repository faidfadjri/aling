<div class="mx-auto shadow-md rounded-lg px-4 py-5 flex flex-col gap-4">

    <div class="flex flex-col gap-2">
        <p class="text-sm font-medium text-gray-700 mb-2">Jenis alamat</p>
        <div class="flex space-x-2">
            @foreach (['kantor', 'rumah', 'lainya'] as $option)
                <button type="button"
                    class="px-5 py-2 text-sm rounded-full border transition cursor-pointer {{ $type === $option ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-800 border-gray-200' }}"
                    wire:click="$set('type', '{{ $option }}')">
                    {{ ucfirst($option) }}
                </button>
            @endforeach
        </div>
        @error('type')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1">
        <select wire:model.live="province_id"
            class="w-full form-select bg-white border border-gray-200 py-2 px-3 rounded-sm disabled:opacity-50 duration-200">
            <option value="">Provinsi</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
        @error('province_id')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex flex-col gap-1">
        <select wire:model.live="regency_id" wire:loading.attr="disabled" wire:target="province_id"
            class="w-full form-select bg-white border border-gray-200 py-2 px-3 rounded-sm disabled:opacity-50 duration-200">
            <option value="">Kabupaten/Kota</option>
            @foreach ($regencies as $regency)
                <option value="{{ $regency->id }}">{{ $regency->name }}</option>
            @endforeach
        </select>
        @error('regency_id')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1">
        <select wire:model.live="district_id" wire:loading.attr="disabled" wire:target="regency_id"
            class="w-full form-select bg-white border border-gray-200 py-2 px-3 rounded-sm disabled:opacity-50 duration-200">
            <option value="">Kecamatan</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1">
        <select wire:model.live="village_id" wire:loading.attr="disabled" wire:target="district_id"
            class="w-full form-select bg-white border border-gray-200 py-2 px-3 rounded-sm disabled:opacity-50 duration-200">
            <option value="">Kelurahan</option>
            @foreach ($villages as $village)
                <option value="{{ $village->id }}">{{ $village->name }}</option>
            @endforeach
        </select>
        @error('village_id')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col gap-1">
        <textarea wire:model.live="description" rows="3"
            class="w-full form-textarea bg-white border border-gray-200 py-2 px-3 rounded-sm disabled:opacity-50 duration-200"
            placeholder="Tambahkan Keterangan"></textarea>
        @error('description')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <button wire:click="save"
        class="w-full py-2 bg-sky-700 text-white rounded-md hover:bg-sky-900 cursor-pointer disabled:bg-sky-700/50 duration-300"
        wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed"
        wire:target="save,province_id,regency_id,district_id,village_id">
        <span wire:loading.remove wire:target="save">+ Alamat Baru</span>
        <span wire:loading wire:target="save">Harap Tunggu...</span>
    </button>


    <div x-data="addAddressSnackbar()" x-init="init()" x-show="visible"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
        :class="{
            'bg-white text-gray-800 border-gray-300': type === 'success',
            'bg-rose-50 text-red-700 border-red-300': type === 'error'
        }"
        class="fixed bottom-4 left-4 z-50 border shadow-md rounded-lg px-4 py-3 text-sm lg:max-w-sm"
        style="display: none;" x-text="message">
    </div>
</div>

@push('scripts')
    <script>
        function addAddressSnackbar() {
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
                    window.addEventListener('success', (event) => {
                        this.show(event.detail.message || 'Alamat berhasil disimpan.', 'success');

                        Swal.fire({
                            title: 'Berhasil!',
                            text: event.detail.message || 'Alamat berhasil disimpan.',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Selesai',
                            cancelButtonText: 'Tambah Lagi',
                            customClass: {
                                popup: 'rounded-xl shadow-lg',
                                title: 'text-lg font-bold text-gray-800',
                                confirmButton: 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-blue-400',
                                cancelButton: 'bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 focus:outline-none focus:ring-gray-400 ms-3',
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('profile.address') }}'
                            }
                        });

                    });

                    window.addEventListener('failed', (event) => {
                        this.show(event.detail.error || 'Terjadi kesalahan saat menyimpan alamat.', 'error');
                    });

                    window.addEventListener('invalid', (event) => {
                        this.show(event.detail.error || 'Gagal menambahkan alamat, periksa form', 'error');
                    });
                }
            }
        }
    </script>
@endpush
