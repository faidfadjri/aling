@extends('layout.app')

@section('content')
    <div class="h-full flex flex-col lg:flex-row items-center justify-center px-0 lg:px-20">
        <div class="hidden lg:flex flex-2 flex-col items-center justify-center">
            <div class="-ml-30 mb-4">
                <img src="/assets/images/vector-courier.webp" alt="courier" class="mx-auto">
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-1 text-center mb-3">
                Ayam Segar Sampai Rumah
            </h1>
            <h2 class="text-xl font-semibold bg-primary px-5 py-2 rounded-md italic text-white w-fit">Aling yang Antar!</h2>
        </div>
        <div class="flex-1 w-full rounded-xl pt-20 px-5 lg:px-0 lg:pt-0">
            <div class="flex flex-col items-center mb-6">
                <img src="/assets/images/logo.webp" alt="Logo Aling" class="w-28 mb-8" />
                <h3 class="text-2xl font-bold text-gray-900 mb-1 text-center">
                    ✨ Selamat Datang di Aling!
                </h3>
                <p class="text-md text-black/50 text-center">
                    Silahkan daftar untuk nikmati kemudahanya
                </p>
            </div>

            <div id="error-message" class="text-sm text-red-600 bg-red-100 p-2 rounded-md text-center hidden mb-4"></div>
            <form id="register-form" method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf

                <div class="flex flex-col gap-3 mb-5">
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0L12 13.5 2.25 6.75m19.5 0L12 13.5m0 0L2.25 6.75" />
                        </svg>
                        <input type="email" name="email" placeholder="Masukan Email"
                            class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            required autocomplete="email" />
                    </div>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.5-1.632z" />
                        </svg>
                        <input type="text" name="name" placeholder="Masukan Nama"
                            class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            required />
                    </div>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.25 4.5l19.5 0M12 2.25v19.5" />
                        </svg>
                        <input type="text" name="phone" placeholder="Masukan No Telp"
                            class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            required />
                    </div>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75M6.75 21h10.5a2.25 2.25 0 002.25-2.25V12a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 12v6.75A2.25 2.25 0 006.75 21z" />
                        </svg>
                        <input type="password" name="password" placeholder="Masukan Kata Sandi"
                            class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            required autocomplete="new-password" />
                    </div>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75M6.75 21h10.5a2.25 2.25 0 002.25-2.25V12a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 12v6.75A2.25 2.25 0 006.75 21z" />
                        </svg>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                            class="shadow-md pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                            required autocomplete="new-password" />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const button = document.getElementById('register-button');
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
