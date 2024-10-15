@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Welcome to the Book Rental System</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">System Overview</div>
                <div class="card-body">
                    <h5 class="card-title">Statistics</h5>
                    <p class="card-text">Number of Users: {{ $numUsers }}</p>
                    <p class="card-text">Number of Genres: {{ $numGenres }}</p>
                    <p class="card-text">Number of Books: {{ $numBooks }}</p>
                </div>
            </div>
        </div>
    </div>
    

    <div class="mt-4 mb-5">
        <h2>Search Books</h2>
        <form action="{{ route('search.books') }}" method="GET" class="form-inline">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search books by title or author" name="query" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

