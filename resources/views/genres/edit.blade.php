@extends('layouts.master')

@section('title', 'Edit Genre')

@section('content')
<div class="container">
    <h1>Edit Genre</h1>
    
    <form method="POST" action="{{ route('genres.update', $genre->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $genre->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $genre->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection 