<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['title', 'author', 'genre_id', 'price', 'publication_year', 'description'];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
