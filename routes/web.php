<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;

// Home and Search Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search-books', [SearchController::class, 'search'])->name('search.books');
Route::get('/search', [BookController::class, 'search'])->name('search');

// Book Routes
Route::resource('books', BookController::class)->except(['show', 'edit', 'update', 'destroy']);
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit')->middleware('can:manage-books');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update')->middleware('can:manage-books');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy')->middleware('can:manage-books');

// Librarian Routes for Books and Genres
Route::middleware(['auth', 'can:manage-books'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
    Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{genre}', [GenreController::class, 'destroy'])->name('genres.destroy');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy')->middleware('can:manage-books');

});

// Genre Routes
Route::get('/genres/{genre}/books', [GenreController::class, 'showBooksByGenre'])->name('genres.show.books');

// Rental Routes
Route::middleware('auth')->group(function () {
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/my-rentals', [RentalController::class, 'myRentals'])->name('rentals.my');
    Route::get('/rentals/{id}', [RentalController::class, 'details'])->name('rentals.details');
    Route::post('/books/borrow/{bookId}', [BookController::class, 'borrow'])->name('books.borrow');
    Route::post('/rentals/update/{borrowId}', [RentalController::class, 'updateStatus'])->name('rentals.update')->middleware('is_librarian');
    Route::post('/rentals/return/{borrowId}', [RentalController::class, 'processReturn'])->name('rentals.return')->middleware('is_librarian');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy')->middleware('can:manage-books');
    Route::get('/rentals/manage', [RentalController::class, 'manageRentals'])->name('rentals.manage')->middleware('can:manage-rentals');


});
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/rentals/manage', [RentalController::class, 'manageRentals'])->name('rentals.manage')->middleware('can:manage-rentals');



// Authentication Routes
Auth::routes();

