<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate(['comment-input' => ['required', 'max:300']]);
        Comment::create(['content' => $validated['comment-input'], 'user_id' => Auth::id(), 'post_id' => $post->id]);

        return redirect()->back();
    }
}
