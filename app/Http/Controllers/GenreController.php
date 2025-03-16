<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->get();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:255',
            'description' => 'nullable'
        ]);

        Genre::create($request->all());
        return redirect()->route('genres.index')->with('success', 'Genre created!');
    }

    public function show($id)
    {
        $genre = Genre::with('books')->findOrFail($id);
        return view('genres.show', compact('genre'));
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:genres,name,'.$id,
            'description' => 'nullable'
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());
        return redirect()->route('genres.index')->with('success', 'Genre updated!');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->route('genres.index')->with('success', 'Genre deleted!');
    }
}