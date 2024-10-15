<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Assuming 'query' is your search term passed from a form

        // Implement your search logic here
        // For example, searching books might look like this:
        $results = Book::where('title', 'like', '%' . $query . '%')->get();

        return view('search.results', compact('results'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%')
                    ->get();

        return view('search.results', compact('books', 'query'));  // Make sure to pass 'query' here
    }

}
