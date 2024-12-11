@extends('layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f8f9fa;">
        <div class="row justify-content-center">
            <h1 class="text-primary text-center">latest Books</h1>
            @foreach ($books as $books)
                <div class="col-md-2 mb-2">
                    <div class="card">
                        <div class="card-header">
                            <h6>{{ $books->title }}</h6>
                            <small>Author: <b>{{ $books->author }}</b></small> <br>
                            <small class="text-primary"><b>{{ $books->created_at->format('d-m-Y') }}</b></small>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- for genre --}}
            {{-- <h3>Total Genres</h3>
            <div class="col-md-6">
                @foreach ($genres as $genre)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $genre->name }}</h5>
                            <p class="card-text">{{ $genre->books_count }} books</p>
                        </div>
                    </div>
                @endforeach

                @endforeach
            </div> --}}



            <div class="col-12">
                <div class="text-center p-2 bg-primary text-white rounded shadow">
                    <h1>Welcome to the Book Management System</h1>
                    <p class="lead">
                        Manage your books efficiently with our easy-to-use system. Track books, add new entries, and search
                        for your favorites.
                        Whether you're an admin or a user, the system is designed to make book management hassle-free.
                    </p>
                    @auth
                        <a href="{{ route('books') }}" class="btn btn-light">Explore Books</a>
                    @else
                        <a href="{{ route('show.login') }}" class="btn btn-light">Login first</a>

                    @endauth
                </div>
            </div>
        </div>


    </div>
@endsection
