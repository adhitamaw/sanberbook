<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Pastikan direktori storage/app/public/book-images ada
            if (!Storage::exists('public/book-images')) {
                Storage::makeDirectory('public/book-images');
            }

            $imagePath = $request->file('image')->store('book-images', 'public');

            Book::create([
                'genre_id' => $request->genre_id,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imagePath,
            ]);

            return redirect()->route('books.index')
                ->with('success', 'Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan buku: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $book = Book::with(['genre', 'comments.user'])->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $imagePath = $request->file('image')->store('book-images', 'public');
            $book->image = $imagePath;
        }

        $book->genre_id = $request->genre_id;
        $book->title = $request->title;
        $book->content = $request->content;
        $book->save();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        // Hapus gambar terkait
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
} 