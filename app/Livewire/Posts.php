<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    public $num_posts = 20;

    public $page = 'feed';
    public $userId;

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

        if ($this->page === 'profile') {
            return view('livewire.posts', ['posts' => Post::with(['user:id,username,display_name', 'comments'])->latest()->where('user_id', $this->userId)->get()]);
        } elseif ($this->page === 'foryou') {
            $users = Auth::user()->following()->pluck('followed_id');

            return view('livewire.posts', ['posts' => Post::with('user', 'comments')->whereIn('user_id', $users)->latest()->get()]);
        }

        return  view('livewire.posts', ['posts' => Post::with(['user:id,username,display_name', 'comments'])->latest()->get()]);
    }

    public function morePosts()
    {
        $this->num_posts += 1;
    }
}
