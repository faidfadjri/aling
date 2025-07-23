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

        <div class="px-5 mt-8">
            <h3 class="font-semibold text-lg text-gray-800 mb-4">
                Outlet di {{ $product->outlet->village->district->regency->name }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($closestOutlet as $outlet)
                    <div class="bg-white border border-blue-100 rounded-2xl shadow-md hover:shadow-lg transition p-5">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2h-4l-2-2-2 2H6a2 2 0 00-2 2v7" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 21h16M4 17h16M10 9h4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">
                                    {{ $outlet->name }}
                                </h4>
                                <p class="text-sm text-gray-600 leading-snug">
                                    {{ $outlet->village->name }},
                                    {{ $outlet->village->district->name }},
                                    {{ $outlet->village->district->regency->name }}
                                </p>
                            </div>
                        </div>

                        @php
                            $rawPhone = $outlet->phone;

                            $cleanPhone = preg_replace('/\D+/', '', $rawPhone);

                            if (str_starts_with($cleanPhone, '0')) {
                                $waNumber = '62' . substr($cleanPhone, 1);
                            } elseif (str_starts_with($cleanPhone, '62')) {
                                $waNumber = $cleanPhone;
                            } elseif (str_starts_with($cleanPhone, '+62')) {
                                $waNumber = substr($cleanPhone, 1);
                            } else {
                                $waNumber = '62' . $cleanPhone;
                            }

                            $waLink = 'https://wa.me/' . $waNumber;
                        @endphp

                        <div class="flex items-center text-gray-700 text-sm mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h2l.4 2M7 5h10l1 5H6.4M5 12h14a2 2 0 012 2v6H3v-6a2 2 0 012-2z" />
                            </svg>
                            <a href="{{ $waLink }}" target="_blank"
                                class="hover:underline text-base font-medium text-gray-800">
                                +62 {{ ltrim($cleanPhone, '0') }}
                            </a>
                        </div>


                        <a href="https://maps.google.com/?q={{ $outlet->coordinates }}" target="_blank"
                            class="mt-5 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A2 2 0 013 15.382V6.618a2 2 0 011.553-1.894L9 2m0 0l6 3m-6-3v18m6-15l5.447 2.724A2 2 0 0121 8.618v8.764a2 2 0 01-1.553 1.894L15 20M15 5v18" />
                            </svg>
                            Petunjuk Arah
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="px-5 mt-5">
            <h3 class="font-semibold text-lg">Ulasan Pembeli</h3>
            <hr class="opacity-20 my-4">
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
