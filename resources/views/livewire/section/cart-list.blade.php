<div class="bg-blue-50 min-h-screen px-4 py-6">
    @if ($cart && $cart->items->count())
        @foreach ($cart->items as $item)
            <div class="bg-white p-4 rounded-lg shadow-sm mb-4" wire:key="cart-item-{{ $item->id }}">
                <div class="flex items-start">
                    <input type="checkbox" wire:click="toggleSelect({{ $item->id }})" @checked(in_array($item->id, $selectedItems))
                        class="mt-1 mr-3 w-4 h-4 text-blue-600 rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500">

                    <div class="flex-1">
                        <div class="flex items-center text-sm text-gray-800 font-semibold mb-4">
                            <span
                                class="bg-gray-200 text-gray-600 w-6 h-6 flex items-center justify-center rounded-full text-xs mr-2">
                                {{ Str::substr(Str::replaceFirst('Outlet ', '', $item->product->outlet->name), 0, 1) }}
                            </span> {{ $item->product->outlet->name }}
                        </div>

                        <div class="flex items-center">
                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : '/assets/images/placeholder.webp' }}"
                                alt="{{ $item->product->name }}" class="w-16 h-16 rounded object-cover mr-4">

                            <div class="flex-1">
                                <p class="text-sm text-gray-700">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-lg font-bold text-gray-900">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center border rounded-lg overflow-hidden ml-4">
                                <button wire:click="decrease({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">−</button>
                                <span class="px-3 text-sm font-medium">
                                    {{ $item->quantity }}
                                </span>
                                <button wire:click="increase({{ $item->id }})"
                                    class="px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="fixed bottom-0 left-0 w-full bg-white p-4 shadow-lg flex items-center justify-between">
            <p class="text-lg font-semibold">
                Rp
                {{ number_format($cart->items->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
            </p>
            <div class="flex items-center gap-3">
                <button wire:click="deleteSelected"
                    class="bg-rose-800 text-white px-4 py-2 rounded-md hover:bg-rose-900 disabled:opacity-50 text-sm lg:text-md"
                    @if (empty($selectedItems)) disabled @endif>
                    Hapus
                </button>
                <button wire:click="orderSelected"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 disabled:opacity-50 text-sm lg:text-md"
                    @if (empty($selectedItems)) disabled @endif>
                    Pesan
                </button>
            </div>
        </div>
    @else
        <div class="text-center text-gray-500">Keranjang kosong.</div>
    @endif
</div>


@push('scripts')
    <script>
        Livewire.on('refresh', () => {
            // document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        });
    </script>
@endpush
