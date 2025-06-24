@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-[#F5FBFF] relative">
        <livewire:components.appbar back="{{ route('product.detail', $product->id) }}" />

        <div class="p-3 pb-0">
            <a class="flex justify-between items-center bg-white px-3 py-5 rounded-xl shadow-sm mb-3"
                href="{{ route('profile.address') }}">
                <div class="px-2 w-full">
                    @if ($address)
                        <h2 class="font-semibold text-lg">Alamat Pengiriman</h2>
                        <hr class="opacity-20 my-2">
                        <h4 class="font-semibold text-sm capitalize">{{ $address->type }}</h4>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ optional($address->village->district->regency->province)->name ?? '-' }},
                            {{ optional($address->village->district->regency)->name ?? '-' }},
                            {{ optional($address->village->district)->name ?? '-' }},
                            {{ optional($address->village)->name ?? '-' }},
                            {{ $address->description ?? '-' }} </p>
                        </p>
                    @else
                        <p class="italic">Alamat belum tersedia, tekan untuk tambahkan alamat</p>
                    @endif
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
