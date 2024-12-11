@extends('layout');
@section('content')
    <div class="container">
        <div class="row  justify-content-center">

            {{-- SUCCESS AND ERROR MESSEGES --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="col-md-5 card shadow py-4">
                <h3>User Login Form</h3>
                <!-- resources/views/register.blade.php -->
                <form method="POST" action="{{ route('loginUser') }}">
                    @csrf
                    <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
                    <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>

                <a href="{{ route('show.register') }}" class="text-primary">Create New Account</a>

            </div>
        </div>
    </div>
@endsection
