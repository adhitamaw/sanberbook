@extends('layouts.master')

@section('title', 'Genre List')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Genre List</h1>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('genres.create') }}" class="btn btn-primary">Add New Genre</a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>
                        <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-sm btn-info">View</a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 