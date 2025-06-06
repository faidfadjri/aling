<link rel="stylesheet" href="/assets/css/navbar.css">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="/assets/images/logo.webp" alt="">
        </a>
        <nav id="navmenu" class="navmenu w-100">
            <ul class="w-100">
                <li class="w-100 mx-3">
                    <form class="position-relative d-none d-md-block w-100">
                        <input type="text" class="form-control ps-5 w-100 search-bar" placeholder="Cari di Aling" />
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    </form>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="d-flex align-items-center justify-content-center gap-2">
            <a class="btn-primary-outline" href="{{ route('login') }}">Masuk</a>
            <a class="btn-primary" href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
</header>
