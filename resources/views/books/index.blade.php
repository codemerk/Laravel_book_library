@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Books List</h1>
    @if ($books->isEmpty())
        <p class="alert alert-info">There are no books available at the moment.</p>
    @else
        <div class="list-group">
            @foreach($books as $book)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('books.show', $book->id) }}" class="mr-3">
                            {{ $book->title }} - {{ $book->authors }}
                        </a>
                        <span class="text-muted">{{ $book->genre ? $book->genre->name : 'No Genre' }}</span>
                    </div>
                    <div class="btn-group" role="group" aria-label="Book Actions">
                        @can('manage-books')
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form method="POST" action="{{ route('books.destroy', $book->id) }}" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan
                        @auth
                            @if($book->in_stock > 0)
                                <form method="POST" action="{{ route('books.borrow', $book->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Borrow</button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>No Stock</button>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

