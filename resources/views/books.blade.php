@extends('layout')

@section('content')
    <div class="container mt-2 w-75 mx-auto">
        <h2 class="text-center mb-4">Books Table</h2>
        <!-- Action and Search Form -->
        <div class="d-flex justify-content-between mb-4">

            @if (Auth::user()->role == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">
                    Add Book
                </button>
            @endif

            <form action="{{ route('book.search') }}" method="POST" class="d-flex">
                @csrf
                <input type="text" class="form-control rounded-4" name="search" id="search"
                    placeholder="Search book">
                <input type="submit" class="btn btn-success mx-2" value="search">
            </form>
        </div>

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

        <!-- Books Table -->
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Publication Year</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="mt-2">
                            <th>{{ $book->id }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->genre->name }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td class="p-1">
                                <!-- View Button -->

                                @if (Auth::user()->role == 'admin')
                                    <!-- Edit Button -->
                                    <a href="{{ route('book.view', ['id' => $book->id]) }}"
                                        class="text-white bg-warning p-2 rounded m-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif

                                <a href="{{ route('book.details', ['id' => $book->id]) }}"
                                    class="text-white bg-primary p-2 rounded m-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>


                                <!-- Delete Button -->
                                @if (Auth::user()->role == 'admin')
                                    <form action="{{ route('book.delete', ['id' => $book->id]) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-danger p-2 rounded m-1 border-0"
                                            onclick="return confirm('Are you sure you want to delete this book?');"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>

    {{-- modal --}}
    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.book') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Title Field -->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <!-- Author Field -->
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>

                                <!-- Price Field -->
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Genre Field -->
                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <select class="form-control" id="genre" name="genre" required>
                                        <option value="">Select Genre</option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Publication Year Field -->
                                <div class="form-group">
                                    <label for="publication_year">Publication Year</label>
                                    <input type="number" class="form-control" id="publication_year"
                                        name="publication_year" required>
                                </div>

                                <!-- Description Field -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- footer --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success" value="Submit"></input>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
