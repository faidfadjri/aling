<link rel="stylesheet" href="/assets/css/navbar.css">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="/assets/images/logo.webp" alt="">
        </a>

        <nav id="navmenu" class="navmenu w-100">
            <ul class="w-100">
                <li class="w-100 mx-3">
                    <form class="position-relative d-none d-md-block w-100 mt-3">
                        <input type="text" class="form-control ps-5 w-100 search-bar" placeholder="Cari di Aling" />
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="d-flex align-items-center justify-content-center gap-2">
            @guest
                <a class="btn-primary-outline" href="{{ route('login') }}">Masuk</a>
                <a class="btn-primary" href="{{ route('register') }}">Daftar</a>
            @endguest

            @auth
                @php
                    $user = auth()->user();
                    $initial = strtoupper(substr($user->name, 0, 1));
                @endphp

                <div class="dropdown d-flex align-items-center gap-2">
                    <a href="#" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                        class="d-flex align-items-center text-decoration-none">

                        <div class="avatar">
                            @if ($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="Avatar" class="avatar-image">
                            @else
                                <span>{{ $initial }}</span>
                            @endif
                        </div>

                        <span class="user-name ms-2 d-none d-md-block">{{ $user->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                        <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="GET">
                                @csrf
                                <button class="dropdown-item" type="submit">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth


            <i class="bi bi-list fs-4 d-md-none mobile-nav-toggle"></i>
        </div>
    </div>
</header>

<!-- Overlay -->
<div id="overlay" class="overlay d-none">
    <form class="search-overlay-form position-relative">
        <input type="text" class="form-control ps-5 w-100 search-bar" placeholder="Cari di Aling" />
        <i class="bi bi-search position-absolute top-50 start-5 translate-middle-y ms-3 text-muted"></i>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.querySelector('.mobile-nav-toggle');
        const navmenu = document.getElementById('navmenu');
        const overlay = document.getElementById('overlay');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                navmenu.classList.toggle('active');
                overlay.classList.toggle('d-none');
                document.body.classList.toggle('mobile-nav-active');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                navmenu.classList.remove('active');
                overlay.classList.add('d-none');
                document.body.classList.remove('mobile-nav-active');
            });
        }
    });
</script>
