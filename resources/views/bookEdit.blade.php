@extends('layout')
@section('content')
 
    <div class="container w-100 justify-content-center">
        <div class="col-md-6 mx-auto card p-3 shadow">
            <h3 class="text-primary">Edit Book</h3>
            <form action="{{ route('book.update', ['id' => $book->id]) }}" method="POST" class="mt-3">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                        </div>
            
                        <!-- Author Field -->
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
                        </div>
            
                        <!-- Price Field -->
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $book->price }}" required>
                        </div>
                    </div>
            
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Genre Field -->
                        {{-- <input type="hidden" value="{{ $book->genre->id }}"> --}}
                        <div class="form-group">
                            <label for="genre">Genre</label>
                             <input type="text" name="genre" class="form-control" value="{{ $book->genre->name }}">
                        </div>
            
                        <!-- Publication Year Field -->
                        <div class="form-group">
                            <label for="publication_year">Publication Year</label>
                            <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ $book->publication_year }}" required>
                        </div>
            
                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $book->description }}</textarea>
                        </div>
                    </div>
                </div>
                {{-- footer --}}
                <div class="modal-footer mt-2"> 
                   <input type="submit" class="btn btn-success" value="Update"></input>
                 </div>
            </form>
        </div>
    </div>
@endsection