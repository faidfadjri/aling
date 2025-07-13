<div class="max-w-4xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Informasi Akun</h2>

    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6 bg-white p-6 rounded-lg shadow-md border border-gray-200">


        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
            <div class="flex items-center space-x-4 mb-3">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview"
                        class="w-16 h-16 rounded-full object-cover border" />
                @elseif ($user->photo ?? false)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Old Photo"
                        class="w-16 h-16 rounded-full object-cover border" />
                @elseif ($currentPhotoUrl ?? false)
                    <img src="{{ $currentPhotoUrl }}" alt="Current Photo"
                        class="w-16 h-16 rounded-full object-cover border" />
                @else
                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 15.232a4 4 0 1 0-6.464 0M12 12v.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                @endif

                @if ($isEditing)
                    <div class="flex items-center gap-2">
                        <svg wire:loading wire:target="photo" class="animate-spin h-4 w-4 text-blue-500 mb-1"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        <div>
                            <input type="file" wire:model="photo"
                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-sky-50 file:text-sky-700
                        hover:file:bg-sky-100"
                                accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG. Maksimal 2MB.</p>
                        </div>
                    </div>
                @endif
            </div>
            @error('photo')
                <span class="error text-sm bg-rose-50 p-2 rounded-sm mt-5">{{ $message }}</span>
            @enderror
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama <span class="text-rose-700">*</span></label>
                <input wire:model.defer="name" type="text" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Username <span
                        class="text-rose-700">*</span></label>
                <input wire:model.defer="username" type="text" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email <span
                        class="text-rose-700">*</span></label>
                <input wire:model.defer="email" type="email" {{ $isEditing ? '' : 'disabled' }}
                    class="mt-3 w-full border border-gray-300 rounded px-3 py-2 bg-white disabled:bg-gray-100" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP <span
                        class="text-rose-700">*</span></label>
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
                    <input wire:model.defer="password" type="password"
                        class="mt-2 w-full border border-gray-300 rounded px-3 py-2" />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input wire:model.defer="password_confirmation" type="password"
                        class="mt-2 w-full border border-gray-300 rounded px-3 py-2" />
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mt-6">
            @if ($isEditing)
                <div class="flex space-x-2">
                    <button type="submit"
                        class="bg-sky-700 hover:bg-sky-800 text-white font-semibold px-4 py-2 rounded flex items-center disabled:bg-sky-900"
                        wire:target="updateProfile" wire:loading.attr="disabled">
                        <svg wire:loading wire:target="updateProfile" class="animate-spin h-4 w-4 text-blue-500 mb-1"
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
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 disabled:bg-gray-400 font-semibold px-4 py-2 rounded"
                        wire:loading.attr="disabled">
                        <svg wire:loading wire:target="cancelEdit" class="animate-spin h-4 w-4 text-blue-500 mb-1"
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
                <div class="flex items-center gap-2">
                    <button type="button" wire:click="enableEdit"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2 rounded disabled:bg-teal-900"
                        wire:loading.attr="disabled">

                        <svg wire:loading wire:target="enableEdit" class="animate-spin h-4 w-4 mb-1 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        <span wire:loading.remove wire:target="enableEdit" class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>

                            Ubah
                        </span>
                    </button>
                    <a href="{{ route('logout') }}"
                        class="flex items-center gap-2 bg-rose-600 text-white px-4 py-2 font-medium rounded-sm hover:bg-rose-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>

                        Keluar
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>
