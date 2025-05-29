 <header id="header" class="header d-flex align-items-center sticky-top">
     <div class="container position-relative d-flex align-items-center justify-content-between">

         <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
             <img src="/images/logo.webp" alt="">
         </a>
         <nav id="navmenu" class="navmenu">
             <ul>
                 <li><a href="#hero" class="{{ $active == 'beranda' ? 'active' : '' }}">Beranda<br></a></li>
                 <li><a href="#gallery" class="{{ $active == 'produk' ? 'active' : '' }}">Produk</a></li>
                 <li><a href="#outlet" class="{{ $active == 'outlet' ? 'active' : '' }}">Outlet</a></li>
                 <li><a href="#promo" class="{{ $active == 'promo' ? 'active' : '' }}">Promo</a></li>
                 <li><a href="#about" class="{{ $active == 'about' ? 'active' : '' }}">Tentang Kami</a></li>
             </ul>
             <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
         </nav>

         <a class="btn-getstarted" href="index.html#book-a-table">Daftar / Masuk</a>
     </div>
 </header>
