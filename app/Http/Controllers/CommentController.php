<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'content' => $request->content,
            'book_id' => $book_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Hanya admin atau pemilik komentar yang bisa menghapus
        if (auth()->user()->role === 'admin' || auth()->id() === $comment->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
} 