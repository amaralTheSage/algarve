<?php

namespace App\Livewire;



use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }


    public function likeComment(Comment $comment)
    {
        if (!Auth::check()) {
            abort(404);
        }
        $comment->likes()->attach(Auth::id());
    }

    public function unlikeComment(Comment $comment)
    {
        if (!Auth::check()) {
            abort(404);
        }
        $comment->likes()->detach(Auth::id());
    }


    public function deleteComment(Comment $comment)
    {
        Gate::authorize('owner_or_admin', $comment);

        Comment::destroy($comment->id);
        $this->dispatch('comments-updated');
    }

    public $comment_input;
    public function createComment($postId)
    {


        if (!Auth::check()) {
            abort(404);
        }

        $this->validate(['comment_input' => ['required', 'max:300']]);
        Comment::create(['content' => $this->comment_input, 'user_id' => Auth::id(), 'post_id' => $postId]);
        $this->comment_input = "";

        $this->dispatch('comments-updated');
    }

    #[On('comments-updated')]
    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::latest()->where('post_id', $this->post->id)->get()]);
    }
}
