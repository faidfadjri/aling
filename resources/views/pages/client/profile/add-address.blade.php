@extends('layout.app')

@section('content')
    <livewire:components.appbar back="{{ route('profile.address') }}" title="Tambah Alamat Baru" />
    <livewire:section.user-address-form :addressID='$addressID' />
@endsection
