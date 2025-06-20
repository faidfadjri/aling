@extends('layout.app')

@section('content')
    <livewire:components.appbar :keyword="$keyword" />
    <livewire:section.product-list :search="$keyword" />
    @include('components.base.bottom-navigation')
@endsection
