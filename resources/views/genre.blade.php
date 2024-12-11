@extends('layout')
@section('content')
    <div class="container mt-2 w-75 mx-auto">
        <h2 class="text-center mb-4">Genre's</h2>

        <!-- Action and Search Form -->
        <div class="container mt-2 w-75 mx-auto">
            <div class="d-flex justify-content-between mb-4">
                @if (Auth::user()->role == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">
                    Add Genre
                </button>
                        @endif
               
                <form action="{{ route('genre.search') }}" method="post" class="d-flex">
                    @csrf
                    <input type="text" class="form-control rounded-4" name="search" id="search"
                        placeholder="Search book" value="{{ request('search') }}">
                    <input type="submit" class="btn btn-success mx-2" value="search" />
                </form>

            </div>

            {{-- error and success messeges --}}
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


        </div>


        <div class="table-responsive">
            <table class="table table-striped text-center table-sm">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        @if (Auth::user()->role == 'admin')
                        <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <th>{{ $genre->id }}</th>
                            <td>{{ $genre->name }}</td>
                            <td class="p-1">
                                <div class="d-flex justify-content-center align-items-center">

                                    @if (Auth::user()->role == 'admin')
                                      <!-- Edit Button -->
                                      <a href="{{ route('genre.edit', ['id' => $genre->id]) }}"
                                        class="text-white bg-warning p-2 rounded m-1 d-flex align-items-center justify-content-center"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('genre.delete', ['id' => $genre->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white bg-danger p-2 rounded m-1 d-flex align-items-center justify-content-center border-0"
                                            onclick="return confirm('Are you sure you want to delete this book?');"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                  
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $genres->links() }}
        </div>
        




    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Genre</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.genre') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Genre Name</label>
                            <input type="text" class="form-control mb-2" name="name">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
