@extends('layout')
@section('content')
    <div class="container w-100 justify-content-center">
        <div class="col-md-6 mx-auto card p-3 shadow">
            <h3 class="text-primary">Edit Genre</h3>
            <form action="{{ route('genre.update', ['id' => $genre->id]) }}" method="POST" class="mt-3">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" id="title" name="name"
                                value="{{ $genre->name }}" required>
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

 