@extends('layouts.master')

@section('title')
    Edit Buku
@endsection

@section('content')
    <div class="container">
        <h1>Edit Buku</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="genre_id" class="form-label">Genre</label>
                <select class="form-control" id="genre_id" name="genre_id" required>
                    <option value="">Pilih Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $book->content) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                @if($book->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" style="max-height: 200px;">
                        <p class="text-muted">Gambar saat ini. Upload gambar baru untuk menggantinya.</p>
                    </div>
                @endif
                <input type="file" class="form-control" id="image" name="image">
            </div>
            
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection 