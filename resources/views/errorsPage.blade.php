 @extends('layout')
 @section('content')
 <div class="container text-center mt-5 justify-content-center">
    <h1 class="display-1">404 - Page Not Found</h1>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
</div>
 @endsection