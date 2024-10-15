@extends('layouts.app')

@section('title', $book->title . ' - Details')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1>{{ $book->title }}</h1>
        </div>
        <div class="card-body">
            <p><strong>Author:</strong> {{ $book->authors }}</p>
            <p><strong>Genre:</strong> {{ $book->genre ? $book->genre->name : 'Not specified' }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Pages:</strong> {{ $book->pages }}</p>
            <p><strong>Language:</strong> {{ strtoupper($book->language_code) }}</p>
            <p><strong>In Stock:</strong> {{ $book->in_stock }}</p>
            <p><strong>Description:</strong> {!! $book->description ? nl2br(e($book->description)) : 'No description available.' !!}</p>

            <!-- Borrowing functionality -->
            @auth
                @if($hasPendingBorrow)
                    <div class="alert alert-info">You have an ongoing rental process for this book.</div>
                @else
                    <form method="POST" action="{{ route('books.borrow', $book->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Borrow this Book</button>
                    </form>
                @endif
            @endauth
        </div>
        <div class="card-footer">
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection

