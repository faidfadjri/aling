<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Aling - Jual Ayam Potong Keliling | Ayam Segar, Halal & Terpercaya</title>
    <meta name="description"
        content="Aling menyediakan ayam potong keliling segar, halal, higienis, dan terpercaya. Pesan ayam potong berkualitas untuk kebutuhan rumah tangga, restoran, dan usaha Anda.">
    <meta name="keywords"
        content="ayam potong, jual ayam potong, ayam keliling, ayam segar, ayam halal, ayam potong keliling, ayam potong murah, ayam potong terdekat, ayam potong higienis, ayam potong terpercaya, jual ayam keliling, ayam broiler, ayam kampung, supplier ayam potong">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Aling - Jual Ayam Potong Keliling | Ayam Segar, Halal & Terpercaya">
    <meta property="og:description"
        content="Pesan ayam potong keliling segar, halal, dan terpercaya dari Aling. Cocok untuk kebutuhan rumah tangga, restoran, dan usaha.">
    <meta property="og:image" content="/images/logo.webp">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Aling - Jual Ayam Potong Keliling | Ayam Segar, Halal & Terpercaya">
    <meta name="twitter:description"
        content="Pesan ayam potong keliling segar, halal, dan terpercaya dari Aling. Cocok untuk kebutuhan rumah tangga, restoran, dan usaha.">
    <meta name="twitter:image" content="/images/logo.webp">

    <!-- Favicons -->
    <link href="/assets/images/logo.webp" rel="icon">
    <link href="/assets/images/logo.webp" rel="apple-touch-icon">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Paytone+One&family=Audiowide&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @font-face {
            font-family: 'Ethnocentric';
            src: url('/assets/fonts/ethnocentric.otf') format('opentype');
            font-display: swap;
        }
    </style>

</head>

<body class="index-page">
    <main class="main h-screen overflow-x-hidden overflow-y-auto bg-[#F5FBFF] pb-25">
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
