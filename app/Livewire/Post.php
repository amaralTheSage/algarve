<?php

namespace App\Livewire;

use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Post extends Component
{
    public $post;

    public function deletePost()
    {
        Gate::authorize('owner_or_admin', $this->post);

        ModelsPost::destroy($this->post->id);
        $this->dispatch('update_list');
    }

    public function likePost()
    {
        if (! Auth::check()) {
            abort(404);
        }
        $this->post->likes()->attach(Auth::id());
    }

    public function unlikePost()
    {
        if (! Auth::check()) {
            abort(404);
        }
        $this->post->likes()->detach(Auth::id());
    }

    public function render()
    {
        return view('livewire.post', []);
    }
}
