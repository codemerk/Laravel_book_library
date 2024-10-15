@extends('layouts.app')

@section('title', 'Books in ' . $genre->name)

@section('content')
<div class="container">
    <h1>Books in {{ $genre->name }}</h1>
    @if($books->isEmpty())
        <p>No books available in this genre.</p>
    @else
        <div class="list-group">
            @foreach($books as $book)
            <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $book->title }}</h5>
                <p class="mb-1">Author: {{ $book->authors }}</p>
                <small>Published on: {{ $book->released_at ? $book->released_at->format('m-d-Y') : 'Date not available' }}</small>
                <p class="mb-1">{{ $book->description }}</p>
            </a>

            @endforeach
        </div>
    @endif
</div>
@endsection

