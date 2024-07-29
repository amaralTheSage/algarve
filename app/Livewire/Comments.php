<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    public $postId = 0;


    use WithPagination;

    public $num_comments = 5;

    public function moreComments()
    {
        $this->num_comments += 5;
    }

    public function mount($postId)
    {
        $this->postId = $postId;
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
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

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
        $this->comment_input = '';

        $this->dispatch('comments-updated');
    }

    #[On('comments-updated')]
    public function render()
    {
        return view('livewire.comments', ['comments' => Comment::latest()->where('post_id', $this->postId)->paginate($this->num_comments)]);
    }
}
