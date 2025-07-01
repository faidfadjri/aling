<div class="space-y-4 text-sm text-gray-700">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="font-medium text-gray-600">Order Number</p>
            <p class="text-gray-900">{{ $order->order_number }}</p>
        </div>
        <div>
            <p class="font-medium text-gray-600">Status</p>
            <p class="capitalize text-gray-900">{{ $order->status }}</p>
        </div>
    </div>

    <hr class="border-t border-gray-200">

    <div>
        <h3 class="text-base font-semibold text-gray-800 mb-2">Items</h3>
        <div class="divide-y divide-gray-100">
            @foreach ($items as $item)
                <div class="py-2">
                    <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $item->quantity }} pcs &middot;
                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
