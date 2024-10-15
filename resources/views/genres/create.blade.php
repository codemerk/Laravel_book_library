@extends('layouts.app')

@section('title', 'Add New Genre')

@section('content')
    <div class="container mt-4">
        <h1>Add New Genre</h1>
        <form action="{{ route('genres.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="style" class="form-label">Style</label>
                <select class="form-control @error('style') is-invalid @enderror" id="style" name="style" required>
                    <option value="">Select Style</option>
                    @foreach(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $style)
                        <option value="{{ $style }}" {{ old('style') == $style ? 'selected' : '' }}>{{ ucfirst($style) }}</option>
                    @endforeach
                </select>
                @error('style')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Genre</button>
        </form>
    </div>
@endsection
