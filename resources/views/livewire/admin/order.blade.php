<div class="p-6 space-y-6">

    @php
        $colors = [
            'pending' => 'bg-gray-100 text-gray-800',
            'diproses' => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-green-100 text-green-800',
            'pengajuan pembatalan' => 'bg-yellow-100 text-yellow-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            'ditolak' => 'bg-rose-100 text-rose-800',
        ];
    @endphp

    {{-- Filter Bar --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex flex-wrap gap-2">
            <input wire:model.debounce.300ms="search" type="text" placeholder="Cari Invoice"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" />

            <select wire:model="status"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                <option value="">Semua Status</option>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>

            <select wire:model="outlet"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                <option value="">Semua Outlet</option>
                @foreach ($outlets as $o)
                    <option value="{{ $o->id }}">{{ $o->name }}</option>
                @endforeach
            </select>

            <input wire:model="startDate" type="date"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" />

            <input wire:model="endDate" type="date"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" />
        </div>

        <div>
            <select wire:model="perPage"
                class="border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                <option value="10">10 Baris</option>
                <option value="25">25 Baris</option>
                <option value="50">50 Baris</option>
                <option value="100">100 Baris</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
        <table class="w-full whitespace-nowrap text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Invoice</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">HP</th>
                    <th class="px-4 py-3">Outlet</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orderOutlets as $orderOutlet)
                    @php
                        $status = $orderOutlet->status ?? '-';
                    @endphp
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $orderOutlet->order->order_number ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $orderOutlet->order->user->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $orderOutlet->order->user->hp ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $orderOutlet->outlet->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span
                                class="text-xs font-semibold px-2.5 py-0.5 rounded {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3">{{ optional($orderOutlet->created_at)->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <x-filament::button wire:click="showDetail({{ $orderOutlet->id }})"
                                wire:loading.attr="disabled" wire:target="showDetail"
                                class="text-blue-600 hover:underline flex items-center gap-2">
                                <span>Detail</span>
                            </x-filament::button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center px-4 py-6 text-gray-500">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $orderOutlets->links() }}
    </div>

    {{-- Detail Modal --}}
    @if ($showModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full p-6 space-y-4">
                <div class="flex items-center justify-between border-b pb-3">
                    <h2 class="text-lg font-semibold">Detail Pesanan</h2>
                    <button wire:click="$set('showModal', false)"
                        class="text-gray-500 hover:text-red-500">&times;</button>
                </div>

                <div>
                    <p><strong>Invoice:</strong> {{ $selectedOrder->order->invoice_number ?? '-' }}</p>
                    <p><strong>Pelanggan:</strong> {{ $selectedOrder->order->customer->name ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        {{ $statuses[$selectedOrder->status] ?? ($selectedOrder->status ?? '-') }}</p>
                </div>

                <div>
                    <h3 class="font-medium mb-2">Daftar Produk:</h3>
                    <ul class="space-y-1">
                        @forelse ($selectedOrder->items as $item)
                            <li>
                                {{ $item->product->name ?? '-' }} - {{ $item->quantity ?? 0 }}x @currency($item->price ?? 0)
                            </li>
                        @empty
                            <li class="text-gray-500">Tidak ada produk.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="text-right">
                    <strong>Total:</strong> @currency($selectedOrder->items->sum(fn($i) => ($i->price ?? 0) * ($i->quantity ?? 0)))
                </div>

                <div class="flex justify-end space-x-2 pt-4 border-t">
                    @foreach ($statuses as $key => $label)
                        @if ($key !== $selectedOrder->status)
                            <button wire:click="updateStatus({{ $selectedOrder->id }}, '{{ $key }}')"
                                class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                Tandai sebagai {{ $label }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
