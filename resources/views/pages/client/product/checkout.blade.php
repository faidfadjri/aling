@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-[#F5FBFF] relative">
        <livewire:components.appbar back="{{ route('product.detail', $productID) }}" />

        <div class="p-3 pb-0">
            <a class="flex justify-between items-center bg-white p-3 rounded-xl shadow-sm mb-3"
                href="{{ route('profile.address') }}">
                <div>
                    <h3 class="font-semibold">Alamat Pengiriman</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $alamat }}
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            <livewire:components.checkout-product :product="$product" />
        </div>
    </div>
@endsection
