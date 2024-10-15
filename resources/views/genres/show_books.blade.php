@extends('layouts.app')

@section('title', 'Books in ' . $genre->name)

@section('content')
<div class="container">
    <h1>Books in Genre: {{ $genre->name }}</h1>
    @if($genre->books->isEmpty())
        <p>No books available in this genre.</p>
    @else
        <ul class="list-group">
            @foreach($genre->books as $book)
                <li class="list-group-item">
                    <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a> - {{ $book->authors }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
