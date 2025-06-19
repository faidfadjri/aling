<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Aling</title>
    <link rel="icon" href="/assets/images/logo.webp" type="image/webp" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F0F8FF] min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm p-6 rounded-xl">
        <div class="flex flex-col items-center mb-6">
            <img src="/assets/images/logo.webp" alt="Logo Aling" class="w-28 mb-4" />
            <h2 class="text-lg font-bold text-gray-900 text-center">
                ✨ Selamat Datang di Aling!
            </h2>
            <p class="text-sm text-gray-600 text-center">
                Pusat Ayam Segar & Layanan Antar Keliling
            </p>
        </div>

        @if (session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-2 rounded-md text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <input type="text" name="email" placeholder="Masukan Username"
                    class="pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="email" />
            </div>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
                <input type="password" name="password" placeholder="Masukan Password"
                    class="pl-10 pr-3 py-3 w-full bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required autocomplete="current-password" />
            </div>


            <button type="submit"
                class="w-full py-2 bg-blue-700 text-white font-semibold rounded-md hover:bg-blue-800 transition">
                Masuk
            </button>
            <a href="{{ route('register') }}"
                class="w-full text-center block py-2 border border-blue-600 text-blue-700 font-semibold rounded-md hover:bg-blue-50 transition">
                Daftar Sekarang
            </a>
        </form>
    </div>
</body>

</html>
