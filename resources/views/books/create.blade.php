@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
    
  <div class="container py-3">
    <h2>Add New Book</h2>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="authors">Authors</label>
        <input type="text" name="authors" class="form-control @error('authors') is-invalid @enderror" id="authors" value="{{ old('authors') }}">
        @error('authors')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class ="form-group">
        <label for ="genre_id">Genre</label>
        <select name="genre_id" class ="form-control @error('genre_id') is-invalid @enderror" id ="genre_id">
          @foreach ($genres as $genre)
          <option value="{{ $genre->id }}">{{ $genre->name }}</option>
          @endforeach 
        </select>
        @error('genre_id')
          <div class="invalid-feedback">
            {{$message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
          <label for="released_at">Released At</label>
          <input type="date" name="released_at" class="form-control @error('released_at') is-invalid @enderror" id="released_at" value="{{ old('released_at') }}">
          @error('released_at')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" id="isbn" value="{{ old('isbn') }}" placeholder="978-3-16-148410-0">
        @error('isbn')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="pages">Number of Pages</label>
        <input type="number" name="pages" class="form-control @error('pages') is-invalid @enderror" id="pages" value="{{ old('pages') }}">
        @error('pages')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="language_code">Language Code (e.g., EN, DE)</label>
        <input type="text" name="language_code" class="form-control @error('language_code') is-invalid @enderror" id="language_code" value="{{ old('language_code') }}">
        @error('language_code')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="in_stock">In Stock</label>
        <input type="number" name="in_stock" class="form-control @error('in_stock') is-invalid @enderror" id="in_stock" value="{{ old('in_stock') }}">
        @error('in_stock')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description') }}</textarea>
        @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Add Book</button>
      </div>

    </form>
  </div>

@endsection
