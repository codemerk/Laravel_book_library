<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Genre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numUsers = User::count();
        $numGenres = Genre::count();
        $numBooks = Book::count();
        $numAvailableBooks = Book::where('status', 'available')->count();  // Ensure your Book model has a 'status' or similar field

        return view('home', compact('numUsers', 'numGenres', 'numBooks', 'numAvailableBooks'));

    }
}
