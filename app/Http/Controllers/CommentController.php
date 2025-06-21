<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Comment::create([
            'recipe_id' => $recipe->id,
            'user_name' => 'Anonim',
            'comment' => $request->comment,
            'rating' => $request->rating,
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}