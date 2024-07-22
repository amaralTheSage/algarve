<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class FormAndPostList extends Component
{
    public $page = 'feed';
    public $userId;

    public $post_input;

    public function createPost()
    {
        if (!Auth::check()) {
            abort(404);
        }

        $this->validate(['post_input' => ['required', 'max:300']]);

        Post::create(['content' => $this->post_input, 'user_id' => Auth::id()]);
        $this->post_input = "";
    }


    #[On('update_list')]
    public function render()
    {
        if ($this->page === 'profile') {
            return view('livewire.posts', ['posts' => Post::with(['user', 'comments'])->latest()->where('user_id', $this->userId)->get()]);
        } elseif ($this->page === 'foryou') {
            $users = Auth::user()->following()->pluck('followed_id');

            return view('livewire.posts', ['posts' => Post::with('user', 'comments')->whereIn('user_id', [...$users, Auth::id()])->latest()->get()]);
        }

        return  view('livewire.form-and-post-list', ['posts' => Post::with(['user', 'comments'])->latest()->get()]);
    }
}
