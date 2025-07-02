<div class="bg-blue-50 min-h-screen p-4">
    <div class="relative mb-4">
        <div class="flex gap-2 overflow-x-auto w-full pr-10">
            <button wire:click="selectCity('')"
                class="flex-shrink-0 px-4 py-2 text-sm rounded-full shadow-sm
            {{ $selectedCity === '' ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}">
                Semua
            </button>
            @foreach ($cities as $city)
                <button wire:click="selectCity('{{ $city }}')"
                    class="flex-shrink-0 px-4 py-2 text-sm rounded-full shadow-sm
                {{ $selectedCity === $city ? 'bg-blue-600 text-white' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}">
                    {{ $city }}
                </button>
            @endforeach
        </div>

        <button
            class="absolute right-0 top-1/2 -translate-y-1/2 px-3 py-2 bg-white rounded-full shadow-md z-10 flex items-center justify-center">
            <svg wire:loading class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
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

    {{-- Grid Container --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @for ($i = 0; $i < 8; $i++)
            <div wire:loading class="bg-white rounded-xl shadow-sm overflow-hidden animate-pulse">
                <div class="w-full h-28 bg-gray-200"></div>
                <div class="p-3 space-y-2">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                    <div class="h-3 bg-gray-200 rounded w-2/4"></div>
                </div>
            </div>
        @endfor
        @foreach ($products as $product)
            <div class="bg-white p-2 rounded-sm shadow-md hover:bg-gray-100 duration-200" wire:loading.remove>
                @include('components.cards.product-card', ['product' => $product])
            </div>
        @endforeach
    </div>
    @include('components.base.pagination', ['pagination' => $products])
</div>
