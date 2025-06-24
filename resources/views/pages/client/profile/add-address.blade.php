@extends('layout.app')

@section('content')
    <livewire:components.appbar back="{{ url()->previous() }}" />
    <livewire:section.user-address-form />
@endsection
