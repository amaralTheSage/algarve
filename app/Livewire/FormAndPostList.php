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
        if (! Auth::check()) {
            abort(404);
        }

        $this->validate(['post_input' => ['required', 'max:300']]);

        Post::create(['content' => $this->post_input, 'user_id' => Auth::id()]);
        $this->post_input = '';
    }

    #[On('update_list')]
    public function render()
    {
        if ($this->page === 'profile') {
            return view('livewire.form-and-post-list', ['posts' => Post::with(['user', 'comments'])->where('user_id', $this->userId)->latest()->get(), 'userId' => $this->userId]);
        } elseif ($this->page === 'foryou') {

            $users = Auth::user()->following()->pluck('followed_id');

            return view('livewire.form-and-post-list', ['posts' => Post::with(['user', 'comments'])->whereIn('user_id', [...$users, Auth::id()])->latest()->get(), 'userId' => Auth::id()]);
        }

        return view('livewire.form-and-post-list', ['posts' => Post::with(['user', 'comments'])->latest()->get(), 'userId' => $this->userId]);
    }
}
