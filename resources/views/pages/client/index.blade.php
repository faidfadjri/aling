@extends('layout.app')

@section('content')
    @include('components.base.appbar', [
        'cart' => true,
    ])
    <section class="relative w-full">
        <div id="banner-carousel" class="relative overflow-hidden p-2">
            <div class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">
                <div class="w-full flex-shrink-0">
                    <img src="/assets/images/banner.png" alt="banner" class="w-full h-50 rounded-xl object-cover">
                </div>
            </div>
            <button type="button"
                class="absolute top-1/2 left-4 -translate-y-1/2 opacity-50 bg-white bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 focus:outline-none"
                aria-label="Previous">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button type="button"
                class="absolute top-1/2 right-4 -translate-y-1/2 opacity-50 bg-white bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 focus:outline-none"
                aria-label="Next">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>

    @include('components.sections.discount')
    @include('components.sections.product-category')
    @include('components.base.bottom-navigation')
@endsection

@push('scripts')
    <script>
        $("#searchbar").on("click", function() {
            location.href = "{{ route('search') }}";
        });
    </script>
@endpush
