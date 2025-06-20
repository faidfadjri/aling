<section class="px-4 py-4 my-3 bg-[linear-gradient(to_right,_#0F4FCE,_#0FCEC4)] w-full">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-white flex items-center gap-1">
            🔥 <span>Diskon Spesial</span>
        </h2>
    </div>

    <div class="swiper myPromoSwiper">
        <div class="swiper-wrapper">
            @foreach ($disc as $promo)
                @include('components.cards.promo-card', ['promo' => $promo])
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script>
        const promoSwiper = new Swiper(".myPromoSwiper", {
            slidesPerView: 2,
            spaceBetween: 16,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 6,
                }
            }
        });
    </script>
@endpush
