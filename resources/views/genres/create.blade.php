@extends('layouts.master')

@section('title', 'Create Genre')

@section('content')
<div class="container">
    <h1>Create New Genre</h1>
    
    <form action="{{ route('genres.store') }}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection 