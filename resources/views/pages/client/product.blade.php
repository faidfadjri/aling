@extends('layout.app')

@section('content')
    @include('components.base.appbar', ['cart' => true])

    <div class="bg-blue-50 min-h-screen p-4">
        <div class="relative mb-4">
            <div class="flex gap-2 overflow-x-auto w-full pr-10">
                @foreach (['Purwokerto', 'Temanggung', 'Purbalingga', 'Solo', 'Temanggung', 'Magelang', 'Semarang'] as $city)
                    <button
                        class="flex-shrink-0 px-4 py-2 bg-gray-50 text-sm text-gray-700 rounded-full shadow-sm hover:bg-gray-100">
                        {{ $city }}
                    </button>
                @endforeach
            </div>

            <button class="absolute right-0 top-1/2 -translate-y-1/2 px-3 py-2 bg-white rounded-full shadow-md z-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </button>
        </div>


        <!-- Produk Grid -->
        <div class="grid grid-cols-2 gap-3">
            @for ($i = 0; $i < 10; $i++)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg" alt="Ayam Potong"
                        class="w-full h-28 object-cover">

                    <div class="p-3 space-y-1">
                        <h3 class="text-sm font-medium text-gray-900 leading-tight">Ayam Potong 5KG</h3>
                        <p class="text-sm text-black font-bold">Rp. 50.000</p>
                        <div class="flex items-center text-xs text-gray-600 gap-1">
                            ⭐ <span>4.6</span> • <span>500 terjual</span>
                        </div>
                        <div class="text-xs text-gray-500">Outlet Purwokerto</div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    @include('components.base.bottom-navigation')
@endsection

@push('scripts')
    <script>
        $("#searchbar").on("click", function() {
            location.href = "{{ route('search') }}";
        });
    </script>
@endpush
