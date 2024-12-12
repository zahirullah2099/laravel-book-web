<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $genres = Genre::paginate(6);
        return view('genre', ['genres' => $genres]);
    }

    //   Display the record by search. 
    public function search(Request $request)
    {  

        $query = Genre::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $genres = $query->paginate(10);
        return view('genre', ['genres' => $genres]);
    }



// adding the genre
    public function addGenre(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:genres,name'
        ]); 
        $genre = new Genre();
        $genre->name = $request->input('name');

        if ($genre->save()) {
            flash()->success('Genre added successfully.');
            return back();
        } else {
            flash()->error('Genre already exists.');
            return back();
        }
    }


    // code for editing the genre
    public function edit($id){

        $genre = Genre::find($id);
        return view('genreEdit', ['genre' => $genre]);
    }

    // code for updating the genre
    public function update(Request $request, string $id){

            $request->validate([
                'name' => 'required|unique:genres,name'
            ]);

            $genre = Genre::find($id);
            $genre->update([
                'name' => $request->input('name')
            ]);
            flash()->success('genre are updated successfylly.');
            return redirect()->route('genre');
            
        }
        
        // code for deletion the genre
        public function genreDelete($id){
            
            $genre = Genre::where('id',$id)->delete();
            if($genre){
            flash()->success('genre deleted successfully.');
            return redirect()->route('genre');
        } else {
            flash()->error('Failed to delete the genre.');
            return redirect()->route('genre');
        }
    }
}
