@extends('layout.app')

@section('content')
    <livewire:components.appbar back="{{ route('profile.address') }}" />
    <livewire:section.user-address-form :addressID='$addressID' />
@endsection
