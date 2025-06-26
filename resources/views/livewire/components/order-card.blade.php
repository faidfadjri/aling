@php
    $badgeColor = match ($order->status) {
        'Dipesan' => 'bg-yellow-100 text-yellow-700',
        'Diproses' => 'bg-red-100 text-red-700',
        'Pengiriman' => 'bg-blue-100 text-blue-700',
        'Tiba di Tujuan' => 'bg-green-100 text-green-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<div class="bg-white rounded-xl p-4 shadow-sm">
    <div class="flex justify-between items-center mb-2">
        <div class="flex items-center gap-3 mb-2">
            <div class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>

            <div class="text-sm flex flex-col">
                <span class="text-xs md:text-sm font-bold">{{ $order->order_number }}</span>
                <span class="text-black/60">{{ $order->date }}</span>
            </div>
        </div>
        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeColor }}">
            {{ $order->status }}
        </span>
    </div>

    <div class="flex items-center gap-4">
        <img src="{{ $order->items[0]->product->image }}" alt="product" class="w-16 h-16 rounded-xl object-cover" />
        <div class="flex-1">
            <div class="text-md font-semibold">{{ $order->product_name }}</div>
            <div class="text-md text-black/60">Qty : {{ $order->qty }}</div>

        </div>
    </div>

    <div class="mt-4 w-full flex items-center justify-between">
        <div>
            <div class="mt-2 text-sm text-gray-500">Total Belanja</div>
            <div class="text-base font-semibold text-gray-900">
                Rp. {{ number_format($order->price, 0, ',', '.') }}
            </div>
        </div>
        <button wire:click="confirm"
            class="bg-primary hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg">
            Konfirmasi Selesai
        </button>
    </div>
</div>
