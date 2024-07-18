<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate(['content-input' => ['required', 'max:300']]);
        Post::create(['content' => $validated['content-input'], 'user_id' => Auth::id()]);

        return to_route('feed')->with('sucess', 'Comment posted succesfully');
    }

    public function show(Post $post)
    {
        return view('Pages.show-post', ['post' => $post]);
    }

    public function destroy(Post $post)
    {

        Gate::authorize('owner_or_admin', $post);

        Post::destroy($post->id);
    }
}
