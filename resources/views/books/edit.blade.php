@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    
  <div class="container py-3">
    <h2>Edit Book (ID = {{ $book['id'] }})</h2>
    <form action="{{ route('books.update', ['book' => $book['id']]) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $book['title']) }}">
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="authors">Authors</label>
        <input type="text" name="authors" class="form-control @error('authors') is-invalid @enderror" id="authors" value="{{ old('authors', $book['authors']) }}">
        @error('authors')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div>
        <label for ="genre_id">Genre</label>
        <select name="genre_id" class="form-control @error('genre_id') is-invalid @enderror" id="genre_id">
          @foreach($genres as $genre)
              <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
          @endforeach
        </select>
        @error('genre_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" id="isbn" value="{{ old('isbn', $book['isbn']) }}" placeholder="978-3-16-148410-0">
        @error('isbn')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="pages">Number of Pages</label>
        <input type="number" name="pages" class="form-control @error('pages') is-invalid @enderror" id="pages" value="{{ old('pages', $book['pages']) }}">
        @error('pages')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="language_code">Language Code (e.g., EN, DE)</label>
        <input type="text" name="language_code" class="form-control @error('language_code') is-invalid @enderror" id="language_code" value="{{ old('language_code', $book['language_code']) }}">
        @error('language_code')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="in_stock">In Stock</label>
        <input type="number" name="in_stock" class="form-control @error('in_stock') is-invalid @enderror" id="in_stock" value="{{ old('in_stock', $book['in_stock']) }}">
        @error('in_stock')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $book['description']) }}</textarea>
        @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Book</button>
      </div>

    </form>
  </div>

@endsection
