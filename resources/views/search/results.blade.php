@extends('layouts.app')

@section('title', 'Search Results for ' . $query)

@section('content')
<div class="container">
    <h1>Search Results for "{{ $query }}"</h1>
    <ul class="list-group">
        @forelse($books as $book)
        <li class="list-group-item">
            <a href="{{ route('books.show', $book->id) }}">
                <h4>{{ $book->title }}</h4>
                <p>Author: {{ $book->authors }}</p>
                <p>Date Published: {{ $book->released_at->toFormattedDateString() }}</p>
                <p>Description: {{ Str::limit($book->description, 150) }}</p>
            </a>
        </li>
        @empty
        <li class="list-group-item">No books found for "{{ $query }}".</li>
        @endforelse
    </ul>
</div>
@endsection
