@extends('layouts.master')

@section('title')
    Daftar Buku
@endsection

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Tambah Buku Baru</a>
            @endif
        @endauth
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($books as $book)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $book->image) }}" 
                             class="card-img-top" 
                             alt="{{ $book->title }}" 
                             style="height: 200px; object-fit: cover">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Genre: {{ $book->genre->name }}</p>
                            <div class="mt-auto">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info flex-fill">Detail</a>
                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning flex-fill">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 