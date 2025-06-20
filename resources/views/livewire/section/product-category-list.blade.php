<section class="px-4 py-6">
    {{-- Tabs --}}
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
            <div class="flex gap-4 w-full overflow-x-auto">
                @foreach ($activeCategory->products->take(6) as $product)
                    @include('components.cards.productCategoryCard', [
                        'productImage' => $product->image ?? 'https://via.placeholder.com/300x200',
                        'productName' => $product->name,
                        'productPrice' => 'Rp. ' . number_format($product->price, 0, ',', '.'),
                        'productOutlet' => $product->outlet->name ?? 'Outlet Tidak Diketahui',
                        'promoDisc' => $product->promo ?? null,
                    ])
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada produk dalam kategori ini.</p>
        @endif
    </div>
</section>
