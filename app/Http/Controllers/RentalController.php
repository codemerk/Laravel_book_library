<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Borrow;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RentalController extends Controller
{
    public function index()
    {
        $borrows = Borrow::where('reader_id', Auth::id())->get();
        return view('rentals.index', compact('borrows'));
    }

    public function manage(Request $request, $borrowId)
    {
        $borrow = Borrow::findOrFail($borrowId);
        // Ensure that only authorized users or librarians can manage the request
        if ($borrow->reader_id == Auth::id() || Auth::user()->is_librarian) {
            $borrow->update($request->all());
            return back()->with('success', 'Rental updated successfully.');
        }

        return back()->with('error', 'Unauthorized access.');
    }
    public function manageRentals()
    {
        $rentals = Borrow::with('book', 'reader')->get()->groupBy('status');
        return view('rentals.manage', compact('rentals'));
    }

    // Add to RentalController

    public function listAll()
    {
        // Only accessible by librarians
        if (!Auth::user()->is_librarian) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $allRentals = Borrow::with('book', 'reader')->get();
        return view('rentals.manage', compact('allRentals'));
    }

    public function updateStatus($id, $status)
    {
        $rental = Borrow::findOrFail($id);
        $rental->status = $status;
        $rental->save();
    
        if ($status === 'ACCEPTED') {
            $rental->book->decrement('in_stock');
        } elseif ($status === 'RETURNED') {
            $rental->book->increment('in_stock');
        }
    
        return back()->with('success', 'Rental status updated.');
    }

    public function processReturn($id)
    {
        return $this->updateStatus($id, 'RETURNED');
    }
    public function myRentals()
    {
        $userId = Auth::id();  // Get the current logged-in user ID
        $rentals = Borrow::with('book')
                        ->where('reader_id', $userId)
                        ->get();

        // Categorize the rentals
        $categories = [
            'pending' => [],
            'accepted' => [],
            'late' => [],
            'rejected' => [],
            'returned' => []
        ];

        foreach ($rentals as $rental) {
            if ($rental->status === 'PENDING') {
                $categories['pending'][] = $rental;
            } elseif ($rental->status === 'ACCEPTED' && $rental->deadline >= now()) {
                $categories['accepted'][] = $rental;
            } elseif ($rental->status === 'ACCEPTED' && $rental->deadline < now()) {
                $categories['late'][] = $rental;
            } elseif ($rental->status === 'REJECTED') {
                $categories['rejected'][] = $rental;
            } elseif ($rental->status === 'RETURNED') {
                $categories['returned'][] = $rental;
            }
        }

        return view('rentals.my_rentals', compact('categories'));
    }
    public function details($id)
    {
        $rental = Borrow::with(['book', 'reader', 'requestManager', 'returnManager'])
                         ->findOrFail($id);
    
        if ($rental->reader_id != auth()->id() && !auth()->user()->is_librarian) {
            abort(403, 'Unauthorized access');
        }
    
        return view('rentals.details', compact('rental'));
    }
    



}