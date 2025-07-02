@extends('layout.app')

@section('content')
    @php
        $last = optional(json_decode(request()->cookie('last-visited-product')));
        $productID = $last->id ?? 0;
    @endphp

    <livewire:components.appbar :back="route('order.checkout', ['productID' => $productID])" />
    <livewire:section.user-address />
@endsection
