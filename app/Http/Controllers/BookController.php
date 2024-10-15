<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Borrow;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /*
      Show the form for creating a new book.
     */

     public function show($id)
     {
         $book = Book::with(['borrows'])->findOrFail($id);
         $hasPendingBorrow = $book->borrows()->where('reader_id', Auth::id())
             ->whereIn('status', ['PENDING', 'ACCEPTED'])->exists();
         
         return view('books.show', compact('book', 'hasPendingBorrow'));
     }
     public function borrow(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        if ($book->borrows()->where('reader_id', Auth::id())->whereIn('status', ['PENDING', 'ACCEPTED'])->exists()) {
            return back()->with('error', 'You have an ongoing rental or request for this book.');
        }

        Borrow::create([
            'book_id' => $bookId,
            'reader_id' => Auth::id(),
            'status' => 'PENDING'
        ]);

        return redirect()->back()->with('success', 'Borrow request submitted.');
    }

    /*
      Store a newly created book in storage.
     */
    public function store(Request $request)
    {

        
        // Validate the request data
        $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'released_at' => 'required|date',
            'isbn' => 'required|unique:books|size:13',
            'pages' => 'required|integer',
            'language_code' => 'required|size:2',
            'in_stock' => 'required|integer',
            'description' => 'nullable'
        ]);

        // Create a new book
        $book = new Book([
            'title' => $request->title,
            'authors' => $request->authors,
            'released_at'=> $request-> released_at,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'language_code' => $request->language_code,
            'in_stock' => $request->in_stock,
            'description' => $request->description
        ]);
        $book->save();
        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /*
      Show the form for editing the specified book.
     */
    public function index()
    {
        // Retrieve all books from the database
        $books = Book::with('genre')->get();  // Assuming 'genre' is a relationship in the Book model
        return view('books.index', compact('books'));
    }
    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres')); 
    }

    /*
     Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'isbn' => 'required|size:13',
            'pages' => 'required|integer',
            'language_code' => 'required|size:2',
            'in_stock' => 'required|integer',
            'description' => 'nullable'
        ]);

        // Update the book
        $book->update($request->all());

        // Redirect to the books list with a success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }
    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }
    public function listByGenre($genre)
    {
        $genre = Genre::where('name', $genre)->firstOrFail();
        $books = $genre->books;  

        return view('genres.list', compact('genre', 'books'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query', '');  // Default to an empty string if 'query' is not set
        $books = Book::query();
    
        if ($query) {
            $books = $books->where('title', 'LIKE', "%{$query}%")
                           ->orWhere('authors', 'LIKE', "%{$query}%");
        }
    
        $books = $books->get();
    
        return view('search\results', compact('books', 'query'));
    }
    
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('home')->with('success', 'Book deleted successfully.');
    }


}

