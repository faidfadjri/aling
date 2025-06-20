@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-[#F5FBFF] relative">
        <livewire:components.appbar back="{{ route('product') }}" />

        <div class="mx-auto px-5 rounded-lg flex flex-col lg:flex-row items-center shadow-sm overflow-hidden lg:mt-10">
            <div class="relative flex-shrink-0 w-full lg:w-1/2">
                <img src="{{ $product->image }}" alt="{{ $product->title }}"
                    class="w-full h-60 lg:h-80 object-cover rounded-lg">
                <button class="absolute top-2 right-2 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M7 4h-2l-3 9v2h20v-2l-3-9h-2v-2h-10v2zm0 0v-2h10v2h-10zm1.5 16c-1.105 0-2-.895-2-2h2c0 .552.448 1 1 1s1-.448 1-1h2c0 1.105-.895 2-2 2zm9 0c-1.105 0-2-.895-2-2h2c0 .552.448 1 1 1s1-.448 1-1h2c0 1.105-.895 2-2 2z" />
                    </svg>
                </button>
            </div>

            <div class="p-4">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-bold text-gray-800">{{ $product->title }}</span>

                </div>
                <h2 class="text-xl lg:text-2xl font-semibold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}
                    <span
                        class="line-through text-gray-400">Rp{{ number_format($product->original_price, 0, ',', '.') }}</span>
                    <span class="text-red-600 text-sm font-semibold">{{ $product->discount_percent }}%</span>
                </h2>
                <p class="text-sm mt-1 text-black"><span class="text-yellow-400">★</span> {{ $product->rating }} ·
                    {{ $product->sold }} terjual</p>

                <p class="text-sm lg:text-md text-black opacity-70 mt-2">{{ $product->description }}</p>
            </div>

            <div
                class="z-90 w-full flex p-4 gap-2 mt-2 fixed lg:relative lg:flex-col lg:items-center bottom-0 bg-white lg:rounded-lg shadow-xl">
                <button
                    class="lg:hidden py-2 flex items-center justify-center gap-2 h-10 w-10 lg:w-full lg:px-4 rounded-lg text-sm bg-green-600 text-white font-semibold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path
                            d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path
                            d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>

                    <span class="hidden lg:flex">Chat CS Outlet</span>
                </button>
                <div class="flex-1 w-auto lg:w-full flex lg:justify-end gap-2">
                    <a class="lg:flex-1 py-2 px-4 w-full lg:w-auto rounded-lg text-sm border border-blue-600 text-blue-600 font-semibold hover:bg-blue-600 hover:text-white duration-300 cursor-pointer lg:min-w-[120px] text-center"
                        href="{{ route('product.checkout', $product->id) }}">
                        Beli Langsung
                    </a>
                    <button
                        class="lg:flex-1 py-2 px-4 w-full lg:w-auto rounded-lg text-sm border border-blue-600 bg-blue-600 text-white font-semibold hover:bg-blue-800 duration-300 cursor-pointer lg:min-w-[120px]">
                        + Keranjang
                    </button>
                </div>

                <div class="hidden lg:flex items-center space-x-6 mt-4 text-sm text-gray-800">
                    <button class="flex items-center space-x-2 hover:text-blue-600"
                        onclick="alert('Chat dengan CS Outlet: Halo, ada yang bisa kami bantu?')" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        <span>CS Outlet</span>
                    </button>
                    <div class="w-px h-5 bg-gray-300"></div>
                    <button class="flex items-center space-x-2 hover:text-blue-600"
                        onclick="alert('Lokasi Outlet: Jl. Dummy No. 123, Jakarta')" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>Lokasi Outlet</span>
                    </button>

                    <div class="w-px h-5 bg-gray-300"></div>

                    <button class="flex items-center space-x-1 hover:text-green-600" onclick="shareLink()" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                        <span>Share</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="px-5 mt-4">
            <h3 class="font-semibold text-lg mb-2">Ulasan Pembeli</h3>
            <div id="review-container" class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-1">
                <div class="swiper review-container px-4">
                    <div class="swiper-wrapper">
                        @foreach ($reviews as $review)
                            <div class="swiper-slide bg-white w-full lg:max-w-1/3 rounded-lg p-3 text-sm shadow-md">
                                <div class="mb-1 text-yellow-400 text-base">
                                    {!! str_repeat('★', $review->rating) !!}
                                </div>
                                <p class="font-semibold">{{ $review->name }} - {{ $review->role }}</p>
                                <p class="text-black opacity-70 mt-1">“{{ $review->comment }}”</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('review-container');
            const indicators = document.querySelectorAll('.indicator-dot');
            const itemWidth = container.querySelector('div')?.offsetWidth || 1;

            container.addEventListener('scroll', () => {
                const index = Math.round(container.scrollLeft / itemWidth);
                indicators.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.remove('bg-gray-300', 'w-3');
                        dot.classList.add('bg-black', 'w-5');
                    } else {
                        dot.classList.remove('bg-black', 'w-5');
                        dot.classList.add('bg-gray-300', 'w-3');
                    }
                });
            });
        });
    </script>

    <script>
        const swiper = new Swiper('.review-container', {
            slidesPerView: 1.2,
            breakpoints: {
                640: {
                    slidesPerView: 2.1,
                },
                1024: {
                    slidesPerView: 3.1,
                }
            },
            grabCursor: true,
            spaceBetween: 16,
            grabCursor: true,
            centeredSlides: false,
            loop: false,
            on: {
                slideChange: function() {
                    updateIndicators(swiper.activeIndex);
                }
            }
        });
    </script>

    <script>
        function shareLink() {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'Cek produk ini:',
                    url: url,
                }).catch((err) => {
                    console.warn('Gagal membagikan:', err);
                });
            } else {
                // Kalau Web Share tidak didukung
                console.log('Web Share API tidak didukung di browser ini.');
            }
        }
    </script>
@endpush
