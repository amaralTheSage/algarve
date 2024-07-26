<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('Pages.profile', ['user' => $user]);
    }

    public function edit(User $user)
    {
        if (! $user->id === Auth::id()) {
            abort(403);
        }

        return view('Pages.edit-profile', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'display_name-input' => ['min:3', 'max:50', 'nullable'],
            'username-input' => [Rule::unique('users', 'username')->ignore($user->id, 'id'), 'max:25', 'alpha_dash', 'nullable'],
            'image-input' => ['image', 'nullable'],
            'bio-input' => ['max:300', 'nullable'],
        ]);

        if ($request->has('image-input')) {
            $imagePath = $request->file('image-input')->store('profile', 'public');
            $validated['image-input'] = $imagePath;

            ! is_null($user->image) && Storage::disk('public')->delete($user->image);
        }

        $user->update([
            'username' => $validated['username-input'],
            'display_name' => $validated['display_name-input'],
            'image' => ($validated['image-input'] ?? $user->image),
            'bio' => $validated['bio-input'],
        ]);

        return to_route('users.show', $user);
    }

    public function follow(User $user)
    {
        $follower = Auth::user();

        $follower->following()->attach($user->id);

        return to_route('users.show', $user);
    }

    public function unfollow(User $user)
    {
        $follower = Auth::user();

        $follower->following()->detach($user->id);

        return to_route('users.show', $user);
    }
}
