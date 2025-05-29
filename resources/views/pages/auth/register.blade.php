<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar - E-Commerce</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />

    <link href="/assets/images/logo.webp" rel="icon">
    <link href="/assets/images/logo.webp" rel="apple-touch-icon">

    <!-- Vendor CSS -->
    <link href="/yummy-red/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/yummy-red/assets/vendor/aos/aos.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="register-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <a href="{{ route('login') }}" class="btn-link-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <img src="/assets/images/logo.webp" alt="E-Commerce Logo" class="register-logo">
        <h2>Daftar Akun</h2>
        <div class="subtitle">Silahkan isi data untuk membuat akun</div>

        <form action="/register" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group input-wrapper">
                <i class="bi bi-person icon-input"></i>
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-envelope icon-input"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-telephone icon-input"></i>
                <input type="tel" class="form-control" name="hp" placeholder="No HP / WhatsApp" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-lock icon-input"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-submit w-100">Daftar Sekarang</button>
        </form>
    </div>

    <!-- JS Files -->
    <script src="/yummy-red/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/yummy-red/assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
