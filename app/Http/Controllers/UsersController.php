<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('Pages.profile', ['user' => $user]);
    }


    public function edit(User $user)
    {
        if (!$user->id === Auth::id()) {
            abort(403);
        }

        return view('Pages.edit-profile', ['user' => $user]);
    }
}