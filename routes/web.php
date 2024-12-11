<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\registerLoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\ValidUser2;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function(){
    return view('home');
})->name('home');
 

// ROUTES FOR LOGIN AND REGISTER
Route::controller(registerLoginController::class)->group(function(){
    Route::get('/login', 'showLogin')->name('show.login')->middleware('guest');
    Route::post('/login', 'loginUser')->name('loginUser')->middleware('guest');
    Route::get('/register', 'showRegister')->name('show.register')->middleware('guest');
    Route::post('/register', 'registerUser')->name('registerUser')->middleware('guest');
    Route::get('/logout', 'logoutUser')->name('logoutUser');
});


// ROUTES FOR BOOKS
Route::middleware('validUser:admin')->controller(BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books')->withoutMiddleware('validUser:admin');
    Route::post('/addBook', 'store')->name('add.book')->withoutMiddleware('validUser2:user');
    Route::post('/bookSearch', 'bookSearch')->name('book.search')->withoutMiddleware('validUser:admin');
    Route::get('bookView/{id}', 'edit')->name('book.view')->withoutMiddleware('validUser2:user');
    Route::post('bookUpdate/{id}', 'update')->name('book.update')->withoutMiddleware('validUser2:user');
    Route::get('bookDetails/{id}', 'bookDetails')->name('book.details')->withoutMiddleware('validUser:admin');
    Route::delete('bookDelete/{id}', 'bookDelete')->name('book.delete')->withoutMiddleware('validUser2:user');
});
 


  // ROUTES FOR GENRE
Route::middleware('validUser:admin')->controller(GenreController::class)->group(function () {
Route::get('/genre', 'index')->name('genre')->withoutMiddleware('validUser:admin'); 
Route::post('/genre/search', 'search')->name('genre.search')->withoutMiddleware('validUser:admin');
Route::post('/addGenre', 'addGenre')->name('add.genre');
Route::get('genreView/{id}', 'edit')->name('genre.edit')->withoutMiddleware('validUser2:user');
Route::post('genreUpdate/{id}', 'update')->name('genre.update')->withoutMiddleware('validUser2:user');
Route::delete('genreDelete/{id}', 'genreDelete')->name('genre.delete')->withoutMiddleware('validUser2:user');
});


// ROUTES FOR USER PROFILE
Route::get('/profile', [UserController::class, 'userProfile'])->name('user.profile');
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('update.profile');


  
