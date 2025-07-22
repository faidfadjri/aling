<div class="space-y-6">

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

    <div class="overflow-x-auto rounded-lg shadow-sm relative">

        <x-filament::input wire:model.live="search" type="search" placeholder="Cari Invoice / Pelanggan"
            style="background: white; border: 1px solid rgb(200, 200, 200);border-radius: 0.5em; margin-bottom: 1em" />

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <select wire:model.live="status"
                    class="text-sm border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 capitalize">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $key => $label)
                        <option value="{{ $label }}">{{ $label }}</option>
                    @endforeach
                </select>

                <select wire:model.live="outlet"
                    class="text-sm border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                    <option value="" selected>Semua Outlet</option>
                    @foreach ($outlets as $o)
                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                    @endforeach
                </select>

                <input wire:model.live="date" type="date"
                    class="text-sm border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" />

            </div>
            <select wire:model.live="perPage"
                class="border-gray-300 rounded-lg  text-sm shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                <option value="5">5 Baris</option>
                <option value="10">10 Baris</option>
                <option value="25">25 Baris</option>
                <option value="50">50 Baris</option>
                <option value="100">100 Baris</option>
            </select>
        </div>

        <div class="flex items-center justify-between" style="margin-bottom: 1em">


            <div wire:target="search,status,outlet,startDate,endDate,perPage" wire:loading>
                <div style="width: 100%;display: flex;align-items: center;justify-content: center;gap: 5px">
                    <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="2"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <p>Sedang Memuat Data...</p>
                </div>
            </div>
        </div>

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
            <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full p-6">
                <div class="flex items-center justify-between border-b mb-5" style="padding-bottom: 10px">
                    <h2 class="text-lg font-semibold">Detail Pesanan</h2>
                    <button wire:click="$set('showModal', false)"
                        class="text-gray-500 hover:text-red-500 bg-gray-500 h-5 w-5 rounded-full">&times;</button>
                </div>

                <div>
                    <p><strong>Invoice:</strong> {{ $selectedOrder->order->order_number ?? '-' }}</p>
                    <p><strong>Pelanggan:</strong> {{ $selectedOrder->order->user->name ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        {{ $statuses[$selectedOrder->status] ?? ($selectedOrder->status ?? '-') }}</p>
                </div>

                <div>
                    <h3 class="font-medium mb-2">
                        <strong>
                            Daftar Produk:
                        </strong>
                    </h3>
                    <ul class="space-y-1">
                        @forelse ($selectedOrder->items as $item)
                            <li>
                                {{ $item->product->name ?? '-' }} - {{ $item->quantity ?? 0 }} x
                                {{ 'Rp. ' . number_format($item->subtotal ?? 0, 0, ',' . '.') }}
                            </li>
                        @empty
                            <li class="text-gray-500">Tidak ada produk.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="text-right mb-4">
                    <strong>Total:</strong>
                    {{ 'Rp. ' . number_format($selectedOrder->subtotal ?? 0, 0, ',' . '.') }}
                </div>

                <div class="flex items-center justify-between pt-4 border-t">
                    <x-filament::button wire:click="$set('showModal', false)" color="gray">
                        Tutup
                    </x-filament::button>
                    <div class="flex justify-end gap-2">
                        @php
                            $status = $selectedOrder->status;
                        @endphp

                        @php
                            $status = $selectedOrder->status;
                        @endphp

                        @if (!in_array($status, $completeStatus))
                            @if ($status === 'pending')
                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'ditolak')"
                                    color="warning">
                                    Tolak Pesanan
                                </x-filament::button>

                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'diproses')"
                                    color="info">
                                    Proses Pesanan
                                </x-filament::button>
                            @endif

                            @if ($status === 'pengajuan pembatalan')
                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'diproses')"
                                    color="info">
                                    Proses Pesanan
                                </x-filament::button>

                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'dibatalkan')"
                                    color="warning">
                                    Batalkan Pesanan
                                </x-filament::button>
                            @endif

                            @if (in_array($status, ['diproses']))
                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'dibatalkan')"
                                    color="warning">
                                    Batalkan Pesanan
                                </x-filament::button>
                                <x-filament::button wire:click="updateStatus({{ $selectedOrder->id }}, 'selesai')"
                                    color="success">
                                    Selesaikan Pesanan
                                </x-filament::button>
                            @endif
                        @else
                            <x-filament::button x-data
                                x-on:click="if (confirm('Apakah kamu yakin ingin menghapus order ini?')) { $wire.deleteOrder({{ $selectedOrder->id }}) }"
                                color="danger">
                                Hapus Order
                            </x-filament::button>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
