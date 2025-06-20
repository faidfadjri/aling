<section class="px-4 py-6">
    <div class="flex items-center justify-between mb-4 w-full">
        <div class="flex w-full overflow-y-hidden overflow-x-auto space-x-6">
            @foreach ($categories as $category)
                <button wire:click="setActiveCategory({{ $category->id }})"
                    class="pb-2 whitespace-nowrap
                            {{ $activeCategoryId === $category->id
                                ? 'font-semibold border-b-2 border-black text-black'
                                : 'text-gray-600 hover:text-black' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    <div>
        @if ($activeCategory && $activeCategory->products->count())
            <div class="swiper product-category-swiper" wire:key="product-swiper-{{ $activeCategory->id }}">
                <div class="swiper-wrapper">
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
            </div>
        @else
            <p class="text-gray-500">Tidak ada produk dalam kategori ini.</p>
        @endif
    </div>
</section>

{{-- @push('scripts')
    <script>
        let productSwiper;

        function initSwiper() {
            if (productSwiper) {
                productSwiper.destroy(true, true);
            }

            const swiperElement = document.querySelector('.product-category-swiper');
            if (swiperElement) {
                productSwiper = new Swiper(swiperElement, {
                    slidesPerView: 1.2,
                    spaceBetween: 12,
                    grabCursor: true,
                    breakpoints: {
                        480: {
                            slidesPerView: 2
                        },
                        640: {
                            slidesPerView: 3
                        },
                        768: {
                            slidesPerView: 4
                        },
                        1024: {
                            slidesPerView: 5.5
                        },
                    },
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initSwiper();
        });

        Livewire.on('reinit-swiper', () => {
            initSwiper();
        });
    </script>
@endpush --}}
