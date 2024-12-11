<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // dashboard 
    public function dashboard()
    {
        // Get the latest 5 books along with their genre
        $books = Book::with('genre')->latest()->take(5)->get();
    
        // Get the genre count
        $genres = Genre::withCount('books')->get();
    
        return view('home', ['books' => $books, 'genres' => $genres]);
    }
    




    // Display a listing of the resource.
     
    public function index()
    {
        if(Auth::guest()){
            return redirect()->back();
        }
        $books = Book::with('genre')->paginate(6);
        $genres = Genre::all(); // Fetch all genres
        return view('books', ['books' => $books, 'genres' => $genres]);
    }
    
  
    // search the book
     
    public function bookSearch(Request $request)
    {
        if(Auth::guest()){
            return redirect()->back();
        }

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

        if(Auth::guest()){
            return redirect()->back();
        }
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
        if(Auth::guest()){
            return redirect()->back();
        }
        // Eager load the related genre (or any other relationships)
        $bookDetail = Book::with('genre')->find($id);
        return view('bookDetails', ['bookDetail' => $bookDetail]);
    }
    

    
    //  Show the form for editing the specified resource.
    
    public function edit(string $id)
    {

        if(Auth::guest()){
            return redirect()->back();
        }
        $book = Book::with('genre')->find($id);
        return view('bookEdit', ['book' => $book]);
    }

    
    //  Update the specified resource in storage.
     
    public function update(Request $request, string $id)
    {
        if(Auth::guest()){
            return redirect()->back();
        }
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
        if(Auth::guest()){
            return redirect()->back();
        }
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
