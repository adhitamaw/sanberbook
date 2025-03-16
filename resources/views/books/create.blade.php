@extends('layouts.master')

@section('title')
    Tambah Buku Baru
@endsection

@section('content')
    <div class="container">
        <h1>Tambah Buku Baru</h1>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="genre_id" class="form-label">Genre</label>
                <select class="form-control" id="genre_id" name="genre_id" required>
                    <option value="">Pilih Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Konten</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection 