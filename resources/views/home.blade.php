@extends('layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f8f9fa;">
        <div class="text-center p-5 bg-primary text-white rounded shadow">
            <h1>Welcome to the Book Management System</h1>
            <p class="lead">
                Manage your books efficiently with our easy-to-use system. Track books, add new entries, and search for your favorites. 
                Whether you're an admin or a user, the system is designed to make book management hassle-free.
            </p>
            <a href="{{ route('books') }}" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </div>
@endsection
