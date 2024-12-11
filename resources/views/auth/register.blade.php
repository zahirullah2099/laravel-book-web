@extends('layout');
@section('content')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-5 card shadow py-4">
                <h3>User Registration Form</h3>
                <!-- resources/views/register.blade.php -->
                <form method="POST" action="{{ route('registerUser') }}">
                    @csrf
                    <input class="form-control mb-2" type="text" name="name" placeholder="Name" required>
                    <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>
                    <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"
                        required>

                    <label class="mt-2" for="role">Select Role:</label>
                    <select class="form-select my-2" name="role" required>
                        <option value="" disabled selected>Admin/User</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>

                    <button class="btn btn-primary" type="submit">Register</button>
                </form>
                <a href="{{ route('show.login') }}" class="text-primary">Already Have an Account</a>
            </div>
        </div>
    </div>
@endsection
