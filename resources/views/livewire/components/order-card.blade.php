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
        <div class="text-sm text-gray-500">Pesanan <span class="text-gray-400 ml-1">{{ $order->date }}</span></div>
        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeColor }}">
            {{ $order->status }}
        </span>
    </div>

    <div class="flex gap-4">
        <img src="{{ $order->image }}" alt="product" class="w-16 h-16 rounded-xl object-cover" />
        <div class="flex-1">
            <div class="text-sm font-semibold">{{ $order->product_name }}</div>
            <div class="text-sm text-gray-500">Qty : {{ $order->qty }}</div>
            <div class="mt-2 text-sm text-gray-500">Total Belanja</div>
            <div class="text-base font-semibold text-gray-900">
                Rp. {{ number_format($order->price, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="mt-4 text-right">
        <button wire:click="confirm"
            class="bg-primary hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg">
            Konfirmasi Selesai
        </button>
    </div>
</div>
