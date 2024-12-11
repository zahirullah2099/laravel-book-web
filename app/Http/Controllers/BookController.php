<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    // Display a listing of the resource.
     
    public function index()
    {
        $books = Book::with('genre')->paginate(6);
        $genres = Genre::all(); // Fetch all genres
        return view('books', ['books' => $books, 'genres' => $genres]);
    }
    
  
    // search the book
     
    public function bookSearch(Request $request)
    {
        $query = Book::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }
        $books = $query->paginate(10);
        $genres = Genre::all(); // Fetch all genres for the dropdown
        return view('books', ['books' => $books, 'genres' => $genres]);
    }
    

   
    //   Store a newly created resource in storage.
      
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'genre' => 'required|numeric',
            'publication_year' => 'required|integer',
            'description' => 'required',
        ]);

        // Create a new Book instance
        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->price = $request->input('price');
        $book->genre_id = $request->input('genre');
        $book->publication_year = $request->input('publication_year');
        $book->description = $request->input('description');

        // Save the book
        if ($book->save()) {
            flash()->success('Book added successfully.');
            return redirect('/books');
        } else {
            flash()->error('Book no added successfully.');
            return redirect('/books');
        }
    }

    /**
     * Display the specified book details.
     */
    public function bookDetails(string $id)
    { 
        // Eager load the related genre (or any other relationships)
        $bookDetail = Book::with('genre')->find($id);
        return view('bookDetails', ['bookDetail' => $bookDetail]);
    }
    

    
    //  Show the form for editing the specified resource.
    
    public function edit(string $id)
    {
        $book = Book::with('genre')->find($id);
        return view('bookEdit', ['book' => $book]);
    }

    
    //  Update the specified resource in storage.
     
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'publication_year' => 'required|integer',
            'description' => 'required',
            'genre' => 'required', 
        ]);

        $book = Book::find($id);
        if(!$book){
            flash()->error('book not found.');
            return redirect()->back();
        }

        $genre = Genre::firstOrCreate(['name' => $request->genre]);

        $book->update([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'price' => $validatedData['price'],
            'publication_year' => $validatedData['publication_year'],
            'description' => $validatedData['description'],
            'genre_id' => $genre->id,
        ]);
        flash()->success('book are updated successfully.');
        return redirect()->route('books');
    }

   
    //  delete the book
     
    public function bookDelete(string $id)
    {
        $bookDelete = Book::where('id', $id)->delete();
    
        if ($bookDelete) {
             flash()->success('Book deleted successfully.');
            return redirect()->route('books');
        } else {
             flash()->error('Failed to delete the book.');
            return redirect()->route('books');
        }
    }
    
}
