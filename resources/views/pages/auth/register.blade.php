<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar - E-Commerce</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="/assets/images/logo.webp" rel="icon">
    <link href="/assets/images/logo.webp" rel="apple-touch-icon">

    <!-- Vendor CSS -->
    <link href="/templates/yummy-red/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/templates/yummy-red/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/templates/yummy-red/assets/vendor/aos/aos.css" rel="stylesheet" />

    <!-- Custom Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>

<body>
    <div class="register-container" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <a href="{{ route('login') }}" class="btn-link-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <img src="/assets/images/logo.webp" alt="E-Commerce Logo" class="register-logo">
        <div class="d-flex flex-column gap-1">
            <h2>Daftar Akun</h2>
            <div class="subtitle">Silahkan isi data untuk membuat akun</div>
        </div>

        <!-- Flash Messages -->
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @elseif (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="form-group input-wrapper">
                <i class="bi bi-person icon-input"></i>
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                    value="{{ old('name') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group input-wrapper">
                <i class="bi bi-envelope icon-input"></i>
                <input type="email" class="form-control" name="email" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>

            <!-- No HP -->
            <div class="form-group input-wrapper">
                <i class="bi bi-telephone icon-input"></i>
                <input type="tel" class="form-control" name="hp" placeholder="No HP / WhatsApp"
                    value="{{ old('hp') }}" required>
            </div>

            <!-- PASSWORD -->
            <div class="form-group position-relative">
                <div class="position-relative">
                    <i class="bi bi-lock icon-input"></i>
                    <input type="password" class="form-control ps-5" name="password" id="password"
                        placeholder="Password" required>
                </div>
                <div id="password-error" class="text-danger small mt-2"></div>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="form-group position-relative">
                <div class="position-relative">
                    <i class="bi bi-lock-fill icon-input"></i>
                    <input type="password" class="form-control ps-5" name="password_confirmation"
                        id="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
                <div id="confirm-password-error" class="text-danger small mt-2"></div>
            </div>


            <!-- Foto Profil -->
            <div class="form-group photo-upload">
                <p>Tambahkan Foto Profile (opsional)</p>
                <label for="photo-upload-input" class="photo-upload-box" tabindex="0"
                    aria-label="Upload Foto Profile">
                    <span class="icon-upload fst-normal">+</span>
                    <input type="file" id="photo-upload-input" name="photo" accept="image/*" />
                </label>
                <img id="photo-preview" class="photo-preview" alt="Preview Foto Profile" style="display: none;" />
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="/templates/yummy-red/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/templates/yummy-red/assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init();

        // Foto preview
        const photoInput = document.getElementById('photo-upload-input');
        const photoPreview = document.getElementById('photo-preview');

        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                photoPreview.src = '';
                photoPreview.style.display = 'none';
            }
        });

        photoPreview.addEventListener('click', () => photoInput.click());

        // Password validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        function validatePassword() {
            const value = password.value;
            const isValid = /^(?=.*[A-Z])(?=.*\d).{8,}$/.test(value);
            passwordError.textContent = isValid ? '' : 'Minimal 8 karakter. Harus ada huruf besar. Harus ada angka.';
        }

        function validateConfirmPassword() {
            confirmPasswordError.textContent =
                confirmPassword.value === password.value ? '' : 'Konfirmasi password tidak cocok.';
        }

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validateConfirmPassword);
    </script>
</body>

</html>
