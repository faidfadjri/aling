<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - E-Commerce</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap"
        rel="stylesheet" />

    <link href="/assets/images/logo.webp" rel="icon">
    <link href="/assets/images/logo.webp" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="/yummy-red/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="login-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <a href="/" class="btn btn-link mb-2"
            style="position: absolute; left: 18px; top: 18px; font-size: 1em;color: black;text-decoration: none">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <img src="/assets/images/logo.webp" alt="E-Commerce Logo" class="login-logo">
        <h2>Aling (Ayam Keliling)</h2>
        <div class="subtitle">Silahkan login sebelum melakukan pemesanan</div>
        <form>
            <div class="form-group input-wrapper">
                <i class="bi bi-person icon-input"></i>
                <input type="text" class="form-control" id="username" placeholder="Email atau username" required
                    autocomplete="username" />
            </div>
            <div class="form-group input-wrapper">
                <i class="bi bi-lock icon-input"></i>
                <input type="password" class="form-control" id="password" placeholder="Password" required
                    autocomplete="current-password" />
            </div>
            <a href="#" class="forgot-link">Lupa kata sandi?</a>
            <button type="submit" class="btn btn-submit w-100 mb-2">Masuk</button>
            <a href="{{ route('register') }}" class="btn btn-register w-100" onclick="location.href='register.html'">
                Daftar
            </a>
        </form>
    </div>

    <!-- Vendor JS Files -->
    <script src="/yummy-red/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/yummy-red/assets/vendor/php-email-form/validate.js"></script>
    <script src="/yummy-red/assets/vendor/aos/aos.js"></script>
    <script src="/yummy-red/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/yummy-red/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/yummy-red/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/yummy-red/assets/js/main.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
