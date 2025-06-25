@extends('layout.app')

@section('content')
    <livewire:components.appbar back="{{ route('product') }}" />
    <livewire:section.cart-list />
@endsection
