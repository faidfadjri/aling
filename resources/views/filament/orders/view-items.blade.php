<div>
    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <hr class="my-2">

    <h3 class="font-bold mb-2">Items:</h3>
    <ul class="list-disc pl-4 space-y-1">
        @foreach ($items as $item)
            <li>
                {{ $item->product->name }} - {{ $item->quantity }} pcs -
                Rp{{ number_format($item->subtotal, 0, ',', '.') }}
            </li>
        @endforeach
    </ul>
</div>
