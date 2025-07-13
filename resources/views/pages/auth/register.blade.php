@extends('layout.app')

@section('content')
    <div class="min-h-screen flex flex-col lg:flex-row items-center justify-center px-1 lg:px-20 py-10 bg-gray-50">
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

        <div class="w-11/12 max-w-md bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col items-center mb-6 text-center">
                <img src="/assets/images/logo.webp" alt="Logo Aling" class="w-24 mb-4" />
                <h3 class="text-2xl font-bold text-gray-900 mb-1">✨ Selamat Datang di Aling!</h3>
                <p class="text-md text-gray-500">Silahkan daftar untuk nikmati kemudahanya</p>
            </div>

            <div id="error-message" class="text-sm text-red-600 bg-red-100 p-2 rounded-md text-center hidden mb-4"></div>

            <form id="register-form" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                {{-- Email --}}
                <input type="email" name="email" placeholder="Masukan Email"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="email" />

                {{-- Username --}}
                <input type="text" name="username" placeholder="Masukan Username"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required />

                {{-- Nama --}}
                <input type="text" name="name" placeholder="Masukan Nama"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required />

                {{-- No HP --}}
                <input type="text" name="hp" placeholder="Masukan No HP"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required />

                {{-- Password --}}
                <input type="password" name="password" placeholder="Masukan Kata Sandi"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="new-password" />

                {{-- Konfirmasi Password --}}
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                    class="shadow-sm px-4 py-3 w-full bg-white rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="new-password" />

                {{-- Tombol --}}
                <div class="flex flex-col gap-2 mt-4">
                    <button type="submit" id="register-button"
                        class="w-full py-2 bg-blue-700 text-white font-semibold rounded-md hover:bg-blue-800 transition">
                        Daftar Sekarang
                    </button>
                    <a href="{{ route('login') }}"
                        class="w-full text-center block py-2 border border-blue-600 text-blue-700 font-semibold rounded-md hover:bg-blue-50 transition">
                        Masuk
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const button = document.getElementById('register-button');
            const errorMessage = document.getElementById('error-message');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                errorMessage.classList.add('hidden');
                errorMessage.textContent = '';
                button.setAttribute('disabled', true);
                const originalText = button.textContent;
                button.textContent = 'Mendaftarkan...';

                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('register.store') }}", {
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
                        throw new Error(result.message || 'Registrasi gagal');
                    }
                } catch (err) {
                    errorMessage.textContent = err.message;
                    errorMessage.classList.remove('hidden');
                    button.removeAttribute('disabled');
                    button.textContent = originalText;
                }
            });
        });
    </script>
@endsection
