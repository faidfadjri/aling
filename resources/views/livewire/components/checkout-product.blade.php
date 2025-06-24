<div class="space-y-2 pb-28 bg-[#F5FBFF]">
    <div class="bg-white p-4 rounded-xl shadow-sm flex gap-4">
        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-20 h-20 object-cover rounded-lg">
        <div class="flex-1">
            <h4 class="font-semibold">{{ $product->title }}</h4>
            <p class="text-primary font-semibold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

            <div class="flex items-center justify-end">
                <div class="flex items-center mt-2 border border-gray-300 w-fit rounded-md">
                    <button wire:click="decrement" class="px-2 py-1 bg-gray-100 text-gray-500 rounded-md">-</button>

                    @if ($isEditing)
                        <input type="number" wire:model="quantity" wire:keydown.enter="stopEditing"
                            class="w-12 text-center px-2 py-1 border-l border-r border-gray-300 focus:outline-none"
                            min="1" autofocus>
                    @else
                        <span class="px-2 py-1 text-gray-700 cursor-pointer" wire:click="startEditing">
                            {{ $quantity }}
                        </span>
                    @endif

                    <button wire:click="increment" class="px-2 py-1 bg-gray-100 text-gray-500 rounded-md">+</button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm">
        <label class="block font-semibold mb-2">CATATAN</label>
        <textarea class="w-full border border-gray-300 rounded-lg p-2 text-sm" rows="3" placeholder="Ketik disini"
            wire:model.defer="note"></textarea>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm space-y-2">
        <h3 class="font-semibold">BILLING</h3>
        <div class="flex justify-between text-sm">
            <span>Total Harga</span>
            <span>{{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span>Biaya Admin</span>
            <span>{{ number_format($biayaAdmin, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-semibold">
            <span>Total Tagihan</span>
            <span>{{ number_format($totalTagihan, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="bg-white fixed bottom-0 left-0 right-0 shadow-md px-4 py-3 flex justify-between items-center">
        <span class="font-semibold text-primary">
            <div wire:loading wire:target="increment,decrement">
                <svg class="animate-spin h-5 w-5 text-primary inline-block" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span class="ml-2">Menghitung...</span>
            </div>

            <span wire:loading.remove wire:target="increment,decrement" class="inline-block">
                Rp. {{ number_format($totalTagihan, 0, ',', '.') }}
            </span>
        </span>
        <button class="bg-primary text-white px-6 py-2 rounded-lg font-semibold" wire:click="proceedOrder"
            wire:loading.attr="disabled">
            Proses Order
        </button>
    </div>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</div>
