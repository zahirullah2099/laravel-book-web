@extends('layout')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4"> 
                <h3 class="text-primary">Book Details</h3>
                <table class="table table-reponsive table-bordered ">
                    <tr>
                        <th>id</th>
                        <td>{{ $bookDetail->id }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $bookDetail->title }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>{{ $bookDetail->author }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $bookDetail->price }}</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>{{ $bookDetail->genre->name }}</td>
                    </tr>
                    <tr>
                        <th>Publication year</th>
                        <td>{{ $bookDetail->publication_year }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $bookDetail->description }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection