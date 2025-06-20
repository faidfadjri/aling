<section
    class="relative p-4 lg:px-10 lg:py-5 my-3 bg-[linear-gradient(to_right,_#0F4FCE,_#0FCEC4)] w-full rounded-lg shadow-md">
    <h2 class="text-xl lg:text-2xl font-bold text-white flex items-center gap-1 mb-5">
        🔥 <span>Diskon Spesial</span>
    </h2>

    <div class="relative">
        <div class="swiper myPromoSwiper">
            <div class="swiper-wrapper">
                @foreach ($disc as $promo)
                    @include('components.cards.promo-card', ['promo' => $promo])
                @endforeach
            </div>
        </div>

        <div
            class="promo-button-prev absolute -left-2 lg:-left-3 p-2 top-1/2 -translate-y-1/2 bg-white rounded-full flex items-center justify-center z-20 shadow-sm cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 lg:w-4 lg:h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
        <div
            class="promo-button-next absolute -right-2 lg:right-2 p-2 top-1/2 -translate-y-1/2 bg-white rounded-full flex items-center justify-center z-20 shadow-sm cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 lg:w-4 lg:h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </div>
</section>


@push('scripts')
    <script>
        const promoSwiper = new Swiper(".myPromoSwiper", {
            slidesPerView: 2,
            spaceBetween: 16,
            grabCursor: true,
            navigation: {
                nextEl: ".promo-button-next",
                prevEl: ".promo-button-prev",
            },
            watchOverflow: false,
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 4,
                    spaceBetween: 5,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 18,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                1440: {
                    slidesPerView: 5,
                    spaceBetween: 16,
                }
            }
        });
    </script>
@endpush
