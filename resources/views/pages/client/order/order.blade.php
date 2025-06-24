@extends('layout.app')

@section('content')
    <livewire:section.order-list :orders='$orders' />
    @include('components.base.bottom-navigation')
@endsection
