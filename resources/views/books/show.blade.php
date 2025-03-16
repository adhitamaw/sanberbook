@extends('layouts.master')

@section('title')
    {{ $book->title }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Book Details Card -->
                <div class="card mb-4">
                    <div class="book-image-container" style="height: 400px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}" 
                             style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">{{ $book->title }}</h1>
                        <p class="text-muted">Genre: {{ $book->genre->name }}</p>
                        <div class="card-text">
                            {!! nl2br(e($book->content)) !!}
                        </div>
                        <div class="mt-4">
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                    </form>
                                @endif
                            @endauth
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card">
                    <div class="card-header">
                        <h3>Comments</h3>
                    </div>
                    <div class="card-body">
                        @auth
                            <!-- Comment Form -->
                            <form action="{{ route('books.comments.store', $book->id) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="mb-3">
                                    <textarea class="form-control" name="content" rows="3" placeholder="Write your comment here..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                Please <a href="{{ route('login') }}">login</a> to add a comment.
                            </div>
                        @endauth

                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse($book->comments()->latest()->get() as $comment)
                                <div class="comment border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>{{ $comment->user->name }}</strong>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        @auth
                                            @if(auth()->user()->role === 'admin' || auth()->id() === $comment->user_id)
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this comment?')">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="mt-2 mb-0">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-muted">No comments yet. Be the first to comment!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
@media (max-width: 768px) {
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .card {
        margin-left: 0;
        margin-right: 0;
    }

    .book-image-container {
        height: 300px !important;
    }
}
</style>
@endsection 