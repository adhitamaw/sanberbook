<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GenreController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthUserMiddleware;

use Illuminate\Support\Facades\Route;

// Admin Routes (hanya bisa diakses admin) - PASTIKAN INI DITEMPATKAN SEBELUM PUBLIC ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    // Genre Management
    Route::get('/genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/genres', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{id}', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{id}', [GenreController::class, 'destroy'])->name('genres.destroy');

    // Book Management
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});

// Public Routes (yang bisa diakses tanpa login) - DITEMPATKAN SETELAH ADMIN ROUTES
Route::get('/', [DashboardController::class, 'index']);
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');

// Tambahkan setelah public routes
Route::get('/check-auth', function() {
    if (auth()->check()) {
        return [
            'authenticated' => true,
            'user' => auth()->user(),
            'role' => auth()->user()->role
        ];
    }
    return [
        'authenticated' => false
    ];
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Auth User Routes
Route::middleware(['auth'])->group(function () {
    // Comments
    Route::post('/books/{book_id}/comments', [CommentController::class, 'store'])->name('books.comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


