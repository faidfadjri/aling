    <footer id="footer" class="footer dark-background">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Alamat Kami</h4>
                        <p>Sumampir Purwokerto,</p>
                        <p>Indonesia</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Kontak</h4>
                        <p>
                            <strong>Telepon:</strong>
                            <a href="{{ env('WHATSAPP_LINK') }}" target="_blank" class="text-white">
                                <span>+62 851 6566 0496</span>
                            </a><br> <strong>Email:</strong> <span>aling@ayampotong.com</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Jam Operasional</h4>
                        <p>
                            <strong>Setiap Hari:</strong> <span>24 Jam</span>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links d-flex">
                        <a href="https://www.instagram.com/aling_pwt/" class="instagram"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ env('WHATSAPP_LINK') }}" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    <div class="mt-2">
                        <img src="/assets/images/logo.webp" alt="Aling Logo" style="max-width: 80px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>2025</span> <strong class="px-1 sitename">Ayam Potong Keliling (Aling)</strong> <span>All Rights
                    Reserved</span>
            </p>
            <div class="credits">
                Website by <a href="#">Aling Team</a>
            </div>
        </div>

    </footer>
