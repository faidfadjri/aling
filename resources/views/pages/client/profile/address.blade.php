@extends('layout.app')

@section('content')
    <livewire:components.appbar back="{{ route('product') }}" />
    <livewire:section.user-address />
@endsection
