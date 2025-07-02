@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-[#F5FBFF] relative">
        <livewire:components.appbar back="{{ route('product') }}" />

        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 text-sm">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @livewire('section.product-detail', ['product' => $product])


        <div class="px-5 mt-4">
            <h3 class="font-semibold text-lg mb-2">Ulasan Pembeli</h3>
            <div id="review-container" class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory px-1">
                @if ($product->reviews->count() > 1)
                    <div class="swiper review-container px-4">
                        <div class="swiper-wrapper flex items-center gap-3">
                            @foreach ($product->reviews as $review)
                                <div class="swiper-slide bg-white w-full lg:max-w-1/3 rounded-lg p-3 text-sm shadow-md">
                                    <div class="mb-1 text-yellow-400 text-base">
                                        {!! str_repeat('★', $review->rating) !!}
                                    </div>
                                    <p class="font-semibold">{{ $review->name }}</p>
                                    <p class="text-black opacity-70 mt-1">“{{ $review->description }}”</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif ($product->reviews->count() === 1)
                    @foreach ($product->reviews as $review)
                        <div class="bg-white w-full lg:max-w-1/3 rounded-lg p-3 text-sm shadow-md">
                            <div class="mb-1 text-yellow-400 text-base">
                                {!! str_repeat('★', $review->rating) !!}
                            </div>
                            <p class="font-semibold">{{ $review->name }}</p>
                            <p class="text-black opacity-70 mt-1">“{{ $review->description }}”</p>
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-500 italic">Belum ada ulasan untuk produk ini.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reviewCount = {{ $product->reviews->count() }};

            function shouldInitSwiper() {
                const width = window.innerWidth;
                if (width < 640) {
                    return reviewCount > 1;
                } else {
                    return reviewCount > 3;
                }
            }

            if (shouldInitSwiper()) {
                new Swiper('.review-container', {
                    slidesPerView: 1.2,
                    breakpoints: {
                        640: {
                            slidesPerView: 2.1
                        },
                        1024: {
                            slidesPerView: 3.1
                        }
                    },
                    grabCursor: true,
                    spaceBetween: 16,
                    centeredSlides: false,
                    loop: false
                });
            }
        });
    </script>
@endpush
