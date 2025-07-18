@php
    $status = $item->status ?? null;
    $badgeColor = match ($status) {
        'pending' => 'bg-yellow-100 text-yellow-700',
        'confirmed' => 'bg-blue-100 text-blue-700',
        'delivered' => 'bg-green-100 text-green-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp


<div class="bg-white rounded-xl p-4 shadow-sm" wire:key="order-{{ $item->id }}">
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
                <span class="text-xs md:text-sm font-bold">{{ $item->order->order_number ?? '-' }}</span>
                <span class="text-black/60">{{ $item->order->created_at->format('d M Y H:i') }}</span>
            </div>
        </div>
        <span class="text-xs font-medium px-3 py-1 rounded-full bg-blue-500 {{ $badgeColor }}">
            {{ ucfirst($item->status) }}
        </span>
    </div>

    <div class="flex flex-col items-start md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-4 relative">
            <img src="{{ $item->items[0]->product?->image ?? '/placeholder.jpg' }}" alt="product"
                class="w-16 h-16 rounded-full object-cover z-20" />
            <div class="flex-1">
                <div class="text-md font-semibold">{{ $item->items[0]->product?->name ?? 'Produk tidak tersedia' }}
                </div>
                @if ($item->items->count() > 1)
                    <div class="text-sm text-black/60">+ {{ $item->items->count() - 1 }} produk lainnya</div>
                @endif
            </div>
        </div>
        <div>
            <div class="mt-2 text-sm text-gray-500">Total Belanja</div>
            <div class="text-base font-semibold text-gray-900">
                Rp. {{ number_format($item->subtotal, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="mt-4 w-full flex items-center justify-end">
        <button wire:click="confirmCancel" wire:key="cancel-{{ $item->id }}"
            class="me-1 cursor-pointer duration-200 text-sm font-medium px-4 py-2 text-primary rounded-lg">
            <span wire:loading.remove wire:target='confirmCancel'>Ajukan Pembatalan</span>
            <span wire:loading wire:target='confirmCancel' class="flex items-center gap-2">
                <div class="animate-spin rounded-full h-3 w-3 border-t-2 border-b-2 border-gray-800"></div>
            </span>
        </button>

        @if (!$item->items()->where('review', true)->exists())
            <button wire:click="review" wire:key="review-{{ $item->id }}"
                class="bg-primary text-white cursor-pointer duration-200 text-sm font-medium px-4 py-2 rounded-lg">
                <span wire:loading.remove wire:target='review'>Berikan Ulasan</span>
                <span wire:loading wire:target='review' class="flex items-center gap-2">
                    <div class="animate-spin rounded-full h-3 w-3 border-t-2 border-b-2 border-white"></div>
                </span>
            </button>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('confirm-cancel', function() {
            Swal.fire({
                title: 'Yakin ingin membatalkan pesanan?',
                text: "Tindakan ini tidak bisa dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('cancelConfirmed');
                }
            });
        });
    </script>
@endpush
