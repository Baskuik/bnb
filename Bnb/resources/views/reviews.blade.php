@extends('layout')

@section('title', 'Reviews')

@section('content')
    <div class="container">
        <h2>Gastenreviews</h2>

        @if($reviews->count())
            @foreach($reviews as $review)
                <div class="mb-3 p-3 border rounded">
                    <h5>{{ $review->naam }}</h5>
                    <p>{{ $review->review }}</p>
                    <small>{{ $review->created_at->format('d-m-Y H:i') }}</small>
                </div>
            @endforeach
        @else
            <p>Er zijn nog geen reviews.</p>
        @endif

        <hr>

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" name="naam" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea name="review" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Verstuur</button>
        </form>
    </div>
@endsection
