@extends('layout')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <h2 class="text-center my-2"> Update Your Profile</h2>
            <div class="col-md-5 card">
                {{-- SUCCESS AND ERROR MESSEGES --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('update.profile') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (Leave empty if not changing)</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- {{ old('name', $user->name) }} --}}
