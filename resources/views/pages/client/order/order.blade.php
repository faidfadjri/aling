@extends('layout.app')

@section('content')
    <livewire:components.Appbar />
    <livewire:section.order-list />
    @include('components.base.bottom-navigation')
@endsection
