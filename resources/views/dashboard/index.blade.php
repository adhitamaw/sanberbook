@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Statistik Utama -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><i class="bi bi-book"></i> Total Buku</h5>
                    <div class="mt-auto">
                        <h2 class="text-primary">{{ $totalBooks }}</h2>
                        <a href="{{ route('books.index') }}" class="small">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><i class="bi bi-tags"></i> Total Genre</h5>
                    <div class="mt-auto">
                        <h2 class="text-success">{{ $totalGenres }}</h2>
                        <a href="{{ route('genres.index') }}" class="small">Lihat Kategori</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><i class="bi bi-chat"></i> Total Komentar</h5>
                    <div class="mt-auto">
                        <h2 class="text-info">{{ $totalComments }}</h2>
                        <a href="#" class="small invisible">Placeholder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Buku Terbaru</h5>
            @auth
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Buku
                </a>
                @endif
            @endauth
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($latestBooks as $book)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $book->image) }}" 
                             class="card-img-top" 
                             alt="{{ $book->title }}"
                             style="height: 150px; object-fit: cover">
                        <div class="card-body">
                            <h6 class="card-title">{{ $book->title }}</h6>
                            <small class="text-muted">{{ $book->genre->name }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- User Terbaru "khusus admin" -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-people"></i> User Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($latestUsers as $user)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $user->name }}
                                    <span class="badge bg-primary">{{ $user->role }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endauth
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Implement chart.js untuk statistik genre
    const ctx = document.getElementById('genreChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($genreStats->pluck('name')) !!},
            datasets: [{
                label: 'Jumlah Buku per Genre',
                data: {!! json_encode($genreStats->pluck('books_count')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection 