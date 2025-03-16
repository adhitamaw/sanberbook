<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalBooks' => Book::count(),
            'totalGenres' => Genre::count(),
            'totalComments' => Comment::count(),
            'latestBooks' => Book::with('genre')->latest()->take(4)->get(),
            'latestUsers' => User::latest()->take(5)->get(),
            'genreStats' => Genre::withCount('books')->orderBy('books_count', 'desc')->get()
        ];

        return view('dashboard.index', $data);
    }
}