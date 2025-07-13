<div class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Informasi Akun</h2>

    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6 bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input wire:model.defer="name" type="text" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input wire:model.defer="username" type="text" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model.defer="email" type="email" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input wire:model.defer="hp" type="text" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('hp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @if ($isEditing)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input wire:model.defer="password" type="password" class="mt-1 w-full border rounded px-3 py-2" />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input wire:model.defer="password_confirmation" type="password"
                        class="mt-1 w-full border rounded px-3 py-2" />
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mt-6">
            @if ($isEditing)
                <div class="flex space-x-2">
                    <button type="submit"
                        class="bg-sky-700 hover:bg-sky-800 text-white font-semibold px-4 py-2 rounded flex items-center"
                        wire:loading.attr="disabled">
                        <svg wire:loading wire:target="updateProfile" class="animate-spin h-4 w-4 text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        <span wire:loading.remove wire:target="updateProfile">
                            Simpan Perubahan
                        </span>
                    </button>
                    <button type="button" wire:click="cancelEdit"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-4 py-2 rounded"
                        wire:loading.attr="disabled">
                        <svg wire:loading wire:target="cancelEdit" class="animate-spin h-4 w-4 text-blue-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        <span wire:loading.remove wire:target="cancelEdit">
                            Batalkan
                        </span>
                    </button>
                </div>
            @else
                <button type="button" wire:click="enableEdit"
                    class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2 rounded"
                    wire:loading.attr="disabled">

                    <svg wire:loading wire:target="enableEdit" class="animate-spin h-4 w-4 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" />
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                    </svg>
                    <span wire:loading.remove wire:target="enableEdit" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>

                        Ubah Informasi
                    </span>
                </button>
            @endif
        </div>
    </form>
</div>
