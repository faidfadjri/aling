<div class="mx-auto shadow-md rounded-lg px-4 py-5 space-y-4">
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">Jenis alamat</p>
        <div class="flex space-x-2">
            @foreach (['kantor', 'rumah', 'lainya'] as $option)
                <button type="button"
                    class="px-4 py-1 text-sm rounded-full border transition
                        {{ $type === $option ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-800 border-gray-200' }}"
                    wire:click="$set('type', '{{ $option }}')">
                    {{ ucfirst($option) }}
                </button>
            @endforeach
        </div>
    </div>

    <select wire:model.live="province_id"
        class="w-full px-4 py-2 rounded-md bg-gray-50 text-gray-700 focus:outline-none border border-gray-300">
        <option value="">Provinsi</option>
        @foreach ($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>

    <select wire:model.live="regency_id"
        class="w-full px-4 py-2 rounded-md bg-gray-50 text-gray-700 focus:outline-none border border-gray-300">
        <option value="">Kabupaten/Kota</option>
        @foreach ($regencies as $regency)
            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
        @endforeach
    </select>

    <select wire:model.live="district_id"
        class="w-full px-4 py-2 rounded-md bg-gray-50 text-gray-700 focus:outline-none border border-gray-300">
        <option value="">Kecamatan</option>
        @foreach ($districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
        @endforeach
    </select>

    <select wire:model.live="village_id"
        class="w-full px-4 py-2 rounded-md bg-gray-50 text-gray-700 focus:outline-none border border-gray-300">
        <option value="">Kelurahan</option>
        @foreach ($villages as $village)
            <option value="{{ $village->id }}">{{ $village->name }}</option>
        @endforeach
    </select>

    <textarea wire:model.live="description" rows="3"
        class="w-full px-4 py-2 rounded-md bg-gray-50 text-gray-700 placeholder-gray-500 focus:outline-none border border-gray-300"
        placeholder="Tambahkan Keterangan"></textarea>

    <button wire:click="save" class="w-full py-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-md"
        wire:loading.attr="disabled">
        <span wire:loading class="inline-block align-middle mr-2">
            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </span>
        <span wire:loading.remove>
            + Alamat Baru
        </span>
        <span wire:loading>
            Harap Tunggu...
        </span>
    </button>
</div>


@push('scripts')
    <script>
        Livewire.on('success', () => {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Alamat berhasil disimpan.',
                icon: 'success',
                confirmButtonText: 'Lanjutkan',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                customClass: {
                    popup: 'rounded-xl shadow-lg',
                    title: 'text-lg font-bold text-gray-800',
                    confirmButton: 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400',
                },
                buttonsStyling: false
            }).then(() => {
                window.location.reload();
            });
        });

        Livewire.on('failed', () => {
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan alamat.',
                icon: 'error',
                confirmButtonText: 'Periksa Lagi',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                customClass: {
                    popup: 'rounded-xl shadow-lg',
                    title: 'text-lg font-bold text-red-700',
                    confirmButton: 'bg-rose-600 text-white px-4 py-2 rounded hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-400',
                },
                buttonsStyling: false
            });
        });
    </script>
@endpush
