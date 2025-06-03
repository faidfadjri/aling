<x-filament::page>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Light gray background */
        }

        .chart-canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="w-full max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <section class="bg-white rounded-xl p-6 shadow-lg transition-all duration-300 ease-in-out hover:shadow-xl">
                <h2 class="text-2xl font-bold text-gray-800 pb-3 mb-4 border-b-2 border-blue-500">Orders Summary</h2>
                <ul class="list-none p-0 m-0">
                    <li class="text-lg mb-2 text-gray-700">Total Orders: <span class="font-bold">120</span></li>
                    <li class="text-lg mb-2 text-gray-700">Pending: <span class="font-bold text-amber-500">30</span></li>
                    <li class="text-lg mb-2 text-gray-700">Confirmed: <span class="font-bold text-blue-600">60</span>
                    </li>
                    <li class="text-lg mb-2 text-gray-700">Delivered: <span class="font-bold text-emerald-500">30</span>
                    </li>
                </ul>
            </section>

            <section
                class="bg-white rounded-xl p-6 shadow-lg transition-all duration-300 ease-in-out hover:shadow-xl flex justify-center items-center">
                <div class="w-full max-w-sm">
                    <h2 class="text-2xl font-bold text-gray-800 pb-3 mb-4 border-b-2 border-blue-500 text-center">Orders
                        Status Chart</h2>
                    <canvas id="ordersChart" class="chart-canvas"></canvas>
                </div>
            </section>

            <section class="bg-white rounded-xl p-6 shadow-lg transition-all duration-300 ease-in-out hover:shadow-xl">
                <h2 class="text-2xl font-bold text-gray-800 pb-3 mb-4 border-b-2 border-blue-500">Products</h2>
                <p class="text-5xl font-extrabold text-gray-800 text-center mt-4">500</p>
            </section>

            <section class="bg-white rounded-xl p-6 shadow-lg transition-all duration-300 ease-in-out hover:shadow-xl">
                <h2 class="text-2xl font-bold text-gray-800 pb-3 mb-4 border-b-2 border-blue-500">Product Categories
                </h2>
                <p class="text-5xl font-extrabold text-gray-800 text-center mt-4">15</p>
            </section>

        </div>
    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Confirmed', 'Delivered'],
                datasets: [{
                    label: 'Orders Status',
                    data: [
                        {{ $pendingOrders ?? 0 }},
                        {{ $confirmedOrders ?? 0 }},
                        {{ $deliveredOrders ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.8)', // kuning (pending)
                        'rgba(59, 130, 246, 0.8)', // biru (confirmed)
                        'rgba(16, 185, 129, 0.8)' // hijau (delivered)
                    ],
                    borderWidth: 2,
                    borderColor: '#fff',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            },
                            color: '#374151',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e40af',
                        titleColor: '#f9fafb',
                        bodyColor: '#f9fafb',
                    },
                },
            }
        });
    </script>
</x-filament::page>
