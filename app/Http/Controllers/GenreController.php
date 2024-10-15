<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'style' => 'required|in:primary,secondary,success,danger,warning,info,light,dark'
        ]);

        Genre::create($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre added successfully!');
    }
    public function listByGenre(Genre $genre)
    {
        // Fetching books related to the genre
        $books = $genre->books;  // Assuming the 'books' relationship is correctly set up in your Genre model
    
        return view('genres.list', compact('genre', 'books'));
    }
    
    


    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'style' => 'required|in:primary,secondary,success,danger,warning,info,light,dark'
        ]);

        $genre->update($request->all());

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully!');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('home')->with('success', 'Genre deleted successfully.');
    }

    public function showBooksByGenre(Genre $genre)
    {
        // Eager load the books associated with the genre
        $genre->load('books');
    
        // Pass the genre and its books to the view
        return view('genres.show_books', compact('genre'));
    }
    
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre');
    }
    


}
