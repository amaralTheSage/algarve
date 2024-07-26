<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.search', ['users' => User::where('username', 'like', "%{$this->search}%")->get(), 'search' => $this->search]);
    }
}
