@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Rentals</h1>
    @foreach(['PENDING', 'ACCEPTED', 'LATE', 'REJECTED', 'RETURNED'] as $status)
        <h3>{{ $status }} Rentals</h3>
        <ul class="list-group mb-4">
            @forelse($rentals[$status] ?? [] as $rental)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Book: {{ $rental->book->title }} by {{ $rental->book->authors }}
                    <span>Rented by: {{ $rental->reader->name }}</span>
                    <div>
                        @if($status === 'PENDING')
                            <a href="{{ route('rentals.update', ['id' => $rental->id, 'status' => 'ACCEPTED']) }}" class="btn btn-success btn-sm">Accept</a>
                            <a href="{{ route('rentals.update', ['id' => $rental->id, 'status' => 'REJECTED']) }}" class="btn btn-danger btn-sm">Reject</a>
                        @elseif($status === 'ACCEPTED' || $status === 'LATE')
                            <a href="{{ route('rentals.return', ['id' => $rental->id]) }}" class="btn btn-primary btn-sm">Mark as Returned</a>
                        @endif
                    </div>
                </li>
            @empty
                <li class="list-group-item">No rentals in this category.</li>
            @endforelse
        </ul>
    @endforeach
</div>
@endsection
