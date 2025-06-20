@extends('layout.app')

@section('content')
    <livewire:components.appbar />
    <section class="relative w-full">
        <div id="banner-carousel" class="relative overflow-hidden p-2">
            <div class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">
                <div class="w-full px-4">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/assets/images/banner/banner-1.webp" alt="banner"
                                    class="rounded-xl object-cover w-full h-40 md:h-64" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/banner/banner-2.webp" alt="banner"
                                    class="rounded-xl object-cover w-full h-40 md:h-64" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/assets/images/banner/banner-3.webp" alt="banner"
                                    class="rounded-xl object-cover w-full h-40 md:h-64" />
                            </div>
                        </div>

                        <div class="swiper-pagination mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.sections.discount')
    <livewire:section.product-category-list />
    @include('components.base.bottom-navigation')
@endsection

@push('scripts')
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.5,
                },
                1024: {
                    slidesPerView: 2.1,
                },
            },
        });
    </script>
@endpush
