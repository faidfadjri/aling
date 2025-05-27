@extends('backend.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Welcome to the Backend Dashboard</h1>
                <p class="text-center">This is the home page of the backend section. @if (Auth::user()->role == 1)
                        Super Admin
                    @elseif(Auth::user()->role == 0)
                        Admin
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
