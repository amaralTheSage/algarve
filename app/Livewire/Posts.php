<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
    public $page = 'feed';
    public $userId = 0;

    public function mount($page, $userId)
    {
        $this->page = $page;
        $this->userId = $userId;
    }



    public function deletePost(Post $post)
    {
        Gate::authorize('owner_or_admin', $post);

        Post::destroy($post->id);
    }

    // public function deleteComment(Comment $comment)
    // {
    //     Gate::authorize('owner_or_admin', $comment);

    //     Comment::destroy($comment->id);
    // }

    // public $comment_input;
    // public function createComment($postId)
    // {

    //     if (!Auth::check()) {
    //         abort(404);
    //     }

    //     $this->validate(['comment_input' => ['required', 'max:300']]);
    //     Comment::create(['content' => $this->comment_input, 'user_id' => Auth::id(), 'post_id' => $postId]);
    //     $this->comment_input = "";
    // }

    public function likePost(Post $post)
    {
        if (!Auth::check()) {
            abort(404);
        }
        $post->likes()->attach(Auth::id());
    }

    public function unlikePost(Post $post)
    {
        if (!Auth::check()) {
            abort(404);
        }
        $post->likes()->detach(Auth::id());
    }

    #[On('post-created')]
    public function render()
    {

        if ($this->page == 'profile') {
            return view('livewire.posts', ['posts' => Post::with(['user:id,username,display_name', 'comments'])->latest()->where('user_id', $this->userId)->get()]);
        }

        return  view('livewire.posts', ['posts' => Post::with(['user:id,username,display_name', 'comments'])->latest()->get()]);
    }
}
