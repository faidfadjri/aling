@extends('layout.app')

@section('content')
    @include('components.base.appbar')

    <div class="p-4 bg-blue-50 min-h-screen">
        <div class="mb-6">
            <h2 class="font-semibold text-gray-800 mb-3">Pencarian Terakhir</h2>
            <div id="history-container" class="flex flex-wrap gap-2">
                <button class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                    5KG</button>
                <button class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                    Kampung</button>
                <button class="px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm">Ayam
                    Boiler</button>
            </div>
        </div>

        <div>
            <h2 class="font-semibold text-gray-800 flex items-center gap-2 mb-3">
                <span>👍</span> Best Seller
            </h2>

            <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm w-full mb-4">
                <img src="https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg" alt="Ayam Kampung"
                    class="w-10 h-10 rounded-full object-cover" />
                <span class="text-sm font-medium text-gray-800">Ayam Kampung 10KG</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const maxHistory = 5;
        const historyKey = 'search_history';

        // Ambil elemen container tombol history
        const historyContainer = document.querySelector('#history-container');

        function loadHistory() {
            const history = JSON.parse(localStorage.getItem(historyKey)) || [];
            historyContainer.innerHTML = '';
            history.forEach(item => {
                const btn = document.createElement('button');
                btn.textContent = item;
                btn.className = 'px-4 py-2 border border-gray-400 bg-black/1 text-gray-700 rounded-full text-sm';
                historyContainer.appendChild(btn);
            });
        }

        function saveToHistory(term) {
            if (!term.trim()) return;

            let history = JSON.parse(localStorage.getItem(historyKey)) || [];

            // Hapus jika sudah ada
            history = history.filter(item => item.toLowerCase() !== term.toLowerCase());

            // Tambahkan di awal
            history.unshift(term);

            // Batasi hanya 5
            history = history.slice(0, maxHistory);

            localStorage.setItem(historyKey, JSON.stringify(history));
        }

        // Saat tekan Enter
        document.getElementById('searchbar').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const value = e.target.value;
                saveToHistory(value);
                loadHistory();
                e.target.value = ''; // kosongkan input setelah disimpan
            }
        });

        // Load saat pertama
        document.addEventListener('DOMContentLoaded', loadHistory);
    </script>
@endpush
