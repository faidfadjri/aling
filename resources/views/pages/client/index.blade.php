@extends('layout.app')

@section('content')
    <livewire:components.appbar />

    <section class="relative w-full px-0 pt-5 lg:px-16">
        @livewire('section.stories')
    </section>

    <section class="relative w-full px-0 pt-5 lg:px-16">
        <div id="banner-carousel" class="relative">
            <div class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">
                <div class="w-full px-4">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($banners as $banner)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $banner->content) }}" alt="{{ $banner->title }}"
                                        class="rounded-xl object-cover w-full h-40 md:h-64" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:px-20">
        @include('components.sections.discount')
        <livewire:section.product-category-list />
    </div>
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
