<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['genre_id', 'title', 'content', 'image'];

    // Relasi dengan Genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
} 