@extends('layout.app')

@section('content')
    <livewire:components.appbar keyword="" />
    @livewire('components.personal-info')
    @include('components.base.bottom-navigation')
@endsection
