<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar - E-Commerce</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="/assets/images/logo.webp" rel="icon">
    <link href="/assets/images/logo.webp" rel="apple-touch-icon">

    <!-- Vendor CSS -->
    <link href="/templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/templates/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/templates/assets/vendor/aos/aos.css" rel="stylesheet" />

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

        {{-- Flash Messages --}}
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group input-wrapper">
                <i class="bi bi-person icon-input"></i>
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                    value="{{ old('name') }}" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-envelope icon-input"></i>
                <input type="email" class="form-control" name="email" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-telephone icon-input"></i>
                <input type="tel" class="form-control" name="hp" placeholder="No HP / WhatsApp"
                    value="{{ old('hp') }}" required>
            </div>

            <div class="form-group input-wrapper">
                <i class="bi bi-lock icon-input"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="form-group input-wrapper">
                <p style="font-size: 12px; opacity: 0.6; text-align: left;font-style: italic">Tambahkan Foto Profile
                    (opsional)</p>
                <input type="file" class="form-control" name="photo" accept="image/*">
            </div>

            <button type="submit" class="btn btn-submit w-100">Daftar Sekarang</button>
        </form>
    </div>

    <script src="/templates/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/templates/assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
