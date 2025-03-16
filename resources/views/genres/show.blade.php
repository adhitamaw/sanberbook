@extends('layouts.master')

@section('title', 'Genre Detail')

@section('content')
<div class="container">
    <h1>Genre Details</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $genre->name }}</h5>
            <p class="card-text">{{ $genre->description ?? 'No description' }}</p>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Edit</a>
                @endif
            @endauth
        </div>
    </div>

    <h2>Books in this Genre</h2>
    
    <div class="row">
        @forelse($genre->books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ Str::limit($book->content, 100) }}</p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No books found in this genre.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        <a href="{{ route('genres.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection 