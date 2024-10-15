@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Rentals</h1>

    @foreach($categories as $categoryName => $rentals)
    <h2>{{ ucfirst($categoryName) }} Rentals</h2>
    @forelse($rentals as $rental)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $rental->book->title }}</h5>
                <p>Author: {{ $rental->book->author }}</p>
                <p>Date Listed: {{ $rental->book->created_at->format('Y-m-d') }}</p>
                <p><a href="{{ route('books.show', $rental->book->id) }}">View Book Details</a></p>
                
                <h6>Rental Information:</h6>
                <p>Borrower: {{ $rental->reader->name }}</p>
                <p>Date of Rental Request: {{ $rental->created_at->format('Y-m-d') }}</p>
                <p>Status: {{ $rental->status }}</p>
                @if($rental->status !== 'PENDING')
                    <p>Date of Procession: {{ $rental->request_processed_at->format('Y-m-d') ?? 'N/A' }}</p>
                    <p>Managed by: {{ $rental->requestManager->name ?? 'N/A' }}</p>
                @endif
                @if($rental->status === 'RETURNED')
                    <p>Date of Return: {{ $rental->returned_at->format('Y-m-d') }}</p>
                    <p>Return Managed by: {{ $rental->returnManager->name }}</p>
                @endif
                @if($rental->deadline < now() && $rental->status === 'ACCEPTED')
                    <p class="text-danger">This rental is late.</p>
                @endif
            </div>
        </div>
    @empty
        <p>No rentals in this category.</p>
    @endforelse
    @endforeach
</div>
@endsection
