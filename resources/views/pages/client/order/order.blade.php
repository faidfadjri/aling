@extends('layout.app')

@section('content')
    <livewire:components.Appbar searchOrder="{{ true }}" />
    <livewire:section.order-list search="{{ $keyword }}" />
    @include('components.base.bottom-navigation')
@endsection
