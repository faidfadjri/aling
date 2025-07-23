<div class="space-y-2 pb-28 bg-[#F5FBFF]">
    @foreach ($products as $product)
        <div class="bg-white p-4 rounded-xl shadow-sm flex gap-4">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="w-20 h-20 object-cover rounded-lg">
            <div class="flex-1">
                <h4 class="font-semibold">{{ $product->name }}</h4>
                <p class="text-primary font-semibold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="flex items-center justify-end">
                    <div class="flex items-center mt-2 border border-gray-300 w-fit rounded-md">
                        <button wire:click="decrement({{ $product->id }})"
                            class="px-2 py-1 bg-gray-100 text-gray-500 rounded-md">-</button>

                        <span class="px-2 py-1 text-gray-700 cursor-pointer">
                            {{ $quantities[$product->id] }}
                        </span>

                        <button wire:click="increment({{ $product->id }})"
                            class="px-2 py-1 bg-gray-100 text-gray-500 rounded-md">+</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
            Rp. {{ number_format($totalTagihan, 0, ',', '.') }}
        </span>
        <button class="bg-primary text-white px-6 py-2 rounded-lg font-semibold" wire:click="proceedOrder"
            wire:loading.attr="disabled">
            Proses Order
        </button>
    </div>
</div>
