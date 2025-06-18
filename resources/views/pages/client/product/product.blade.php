@extends('layout.app')

@section('content')
    <livewire:components.appbar />
    <livewire:section.product-list />
    @include('components.base.bottom-navigation')
@endsection
