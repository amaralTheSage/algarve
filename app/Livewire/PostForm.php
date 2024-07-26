<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostForm extends Component
{
    public $post_input;

    public function createPost()
    {
        if (! Auth::check()) {
            abort(404);
        }

        $this->validate(['post_input' => ['required', 'max:300']]);

        Post::create(['content' => $this->post_input, 'user_id' => Auth::id()]);
        $this->post_input = '';

        $this->dispatch('update_list');
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
