@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Genres</h1>
    <a href="{{ route('genres.create') }}" class="btn btn-primary">Add New Genre</a>
    <ul>
        @foreach($genres as $genre)
            <li class="d-flex align-items-center justify-content-between">
                <a href="{{ route('genres.show.books', $genre->id) }}">{{ $genre->name }}</a>
                <div>
                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this genre?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
