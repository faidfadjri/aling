@extends('layout.app')

@section('content')
    <div class="h-full flex flex-col lg:flex-row items-center justify-center px-0 lg:px-20">
        <div class="hidden lg:block flex-2 flex flex-col items-center justify-center">
            <div class="-ml-30 mb-4">
                <img src="/assets/images/vector-courier.webp" alt="courier" class="mx-auto">
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-1 text-center mb-3">
                Ayam Segar Sampai Rumah
            </h1>
            <h2 class="text-xl font-semibold bg-primary px-5 py-2 rounded-md italic text-white">Aling yang Antar!</h2>
        </div>
        <div class="flex-1 w-full rounded-xl pt-20 px-5 lg:px-0 lg:pt-0">
            <div class="flex flex-col items-center mb-6">
                <img src="/assets/images/logo.webp" alt="Logo Aling" class="w-28 mb-8" />
                <h3 class="text-2xl font-bold text-gray-900 mb-1 text-center">
                    ✨ Selamat Datang di Aling!
                </h3>
                <p class="text-md text-black/50 text-center">
                    Pusat Ayam Segar & Layanan Antar Keliling
                </p>
            </div>

            <div id="error-message"
                class="text-sm font-medium text-rose-700 bg-rose-50 p-2 rounded-md text-center mb-4 hidden"></div>
            <form id="login-form" class="space-y-4 z-50">
                @csrf
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <input type="text" name="username" placeholder="Masukan Username"
                        class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                        required autocomplete="username" />
                </div>

                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <input type="password" name="password" placeholder="Masukan Password"
                        class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                        required autocomplete="current-password" />
                </div>

                <div class="flex flex-col gap-2">
                    <button type="submit" id="login-button"
                        class="w-full py-2 bg-blue-700 text-white font-semibold rounded-md hover:bg-blue-800 transition flex justify-center items-center gap-2">
                        <span id="submit-label">Masuk</span>
                        <svg id="loading-spinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </button>

                    <a href="{{ route('register') }}"
                        class="w-full text-center block py-2 border border-blue-600 text-blue-700 font-semibold rounded-md hover:bg-blue-50 transition">
                        Daftar Sekarang
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const button = document.getElementById('login-button');
            const spinner = document.getElementById('loading-spinner');
            const label = document.getElementById('submit-label');
            const errorMessage = document.getElementById('error-message');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Reset UI
                errorMessage.classList.add('hidden');
                errorMessage.textContent = '';
                button.setAttribute('disabled', true);
                spinner.classList.remove('hidden');
                label.classList.add('hidden');

                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('login.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        window.location.href = result.redirect || '/';
                    } else {
                        throw new Error(result.message || 'Login gagal');
                    }
                } catch (err) {
                    errorMessage.textContent = err.message;
                    errorMessage.classList.remove('hidden');
                    button.removeAttribute('disabled');
                    spinner.classList.add('hidden');
                    label.classList.remove('hidden');
                }
            });
        });
    </script>
@endsection
