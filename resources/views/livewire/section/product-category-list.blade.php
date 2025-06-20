<section class="px-4 py-6">
    <div class="flex items-center justify-between mb-4 w-full">
        <div class="flex items-center w-full overflow-y-hidden overflow-x-auto space-x-6">
            @foreach ($categories as $category)
                <button wire:click="setActiveCategory({{ $category->id }})"
                    class="pb-2 whitespace-nowrap
                            {{ $activeCategoryId === $category->id
                                ? 'font-semibold border-b-2 border-black text-black'
                                : 'text-gray-600 hover:text-black' }}">
                    {{ $category->name }}
                </button>
            @endforeach

            <a href="{{ route('product') }}" class="font-bold text-primary text-md">Lihat Semua</a>
        </div>
    </div>

    <div class="flex gap-2">
        @php
            $isMobile =
                request()->header('User-Agent') &&
                preg_match('/Mobile|Android|iP(hone|od|ad)/i', request()->header('User-Agent'));
            $skeletonCount = $isMobile ? 2 : 6;
        @endphp
        @for ($i = 0; $i < $skeletonCount; $i++)
            <div class="w-[160px] sm:w-[200px] md:w-[220px] lg:w-[250px] h-60 lg:h-70 bg-white p-3" wire:loading>
                <div class="h-[120px] bg-gray-200 rounded-md animate-pulse"></div>
                <div class="mt-2 h-4 bg-gray-200 rounded animate-pulse"></div>
                <div class="mt-1 h-4 w-2/3 bg-gray-200 rounded animate-pulse"></div>
                <div class="mt-1 h-3 w-1/2 bg-gray-200 rounded animate-pulse"></div>
            </div>
        @endfor
    </div>


    @if ($activeCategory && $activeCategory->products->count())
        <div class="swiper product-category-swiper relative" wire:loading.remove
            wire:key="product-swiper-{{ $activeCategory->id }}">
            <div class="swiper-wrapper h-full py-5">
                @foreach ($activeCategory->products->take(6) as $index => $product)
                    <div class="swiper-slide w-auto" wire:key="product-{{ $index }}">
                        @include('components.cards.product-category-card', [
                            'productImage' => $product->image ?? 'https://via.placeholder.com/300x200',
                            'productName' => $product->name,
                            'productPrice' => 'Rp. ' . number_format($product->price, 0, ',', '.'),
                            'productOutlet' => $product->outlet->name ?? 'Outlet Tidak Diketahui',
                            'promoDisc' => $product->promo ?? null,
                        ])
                    </div>
                @endforeach
            </div>
            <div
                class="category-button-prev absolute -left-2 lg:-left-3 p-2 top-1/2 -translate-y-1/2 bg-white rounded-full flex items-center justify-center z-20 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 lg:w-4 lg:h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <div
                class="category-button-next absolute -right-2 lg:right-2 p-2 top-1/2 -translate-y-1/2 bg-white rounded-full flex items-center justify-center z-20 shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 lg:w-4 lg:h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    @else
        <p class="text-gray-500">Tidak ada produk dalam kategori ini.</p>
    @endif
</section>

@push('scripts')
    <script>
        let productSwiper;

        function initSwiper() {
            if (productSwiper) {
                productSwiper.destroy(true, true);
            }

            const swiperElement = document.querySelector('.product-category-swiper');
            if (swiperElement) {
                productSwiper = new Swiper(swiperElement, {
                    slidesPerView: 2,
                    spaceBetween: 16,
                    grabCursor: true,
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
                    },
                    navigation: {
                        nextEl: ".category-button-next",
                        prevEl: ".category-button-prev",
                    },
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initSwiper();
        });

        Livewire.on('reinit-swiper', () => {
            requestAnimationFrame(() => {
                initSwiper();
            });
        });
    </script>
@endpush
