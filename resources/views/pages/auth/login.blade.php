@extends('layout.app')

@section('content')
    <div class="min-h-screen flex flex-col lg:flex-row items-center justify-center px-6 lg:px-20 py-10 bg-gray-50">
        {{-- Sisi Kiri - Gambar dan Tagline --}}
        <div class="hidden lg:flex w-full lg:w-1/2 flex-col items-center justify-center px-4">
            <div class="mb-6">
                <img src="/assets/images/vector-courier.webp" alt="courier" class="mx-auto max-w-sm w-full">
            </div>
            <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">
                Ayam Segar Sampai Rumah
            </h1>
            <h2 class="text-xl font-semibold bg-primary px-5 py-2 rounded-md italic text-white mt-2">
                Aling yang Antar!
            </h2>
        </div>

        {{-- Form Login --}}
        <div class="w-full max-w-md bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col items-center mb-6 text-center">
                <img src="/assets/images/logo.webp" alt="Logo Aling" class="w-24 mb-4" />
                <h3 class="text-2xl font-bold text-gray-900 mb-1">✨ Selamat Datang di Aling!</h3>
                <p class="text-md text-gray-500">Pusat Ayam Segar & Layanan Antar Keliling</p>
            </div>

            <div id="error-message"
                class="text-sm font-medium text-rose-700 bg-rose-100 p-2 rounded-md text-center mb-4 hidden">
            </div>

            <form id="login-form" class="space-y-4" method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Username --}}
                <input type="text" name="username" placeholder="Masukan Username"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="username" />

                {{-- Password --}}
                <input type="password" name="password" placeholder="Masukan Kata Sandi"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="current-password" />

                <div class="flex flex-col gap-2 mt-4">
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

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const button = document.getElementById('login-button');
            const spinner = document.getElementById('loading-spinner');
            const label = document.getElementById('submit-label');
            const errorMessage = document.getElementById('error-message');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

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
