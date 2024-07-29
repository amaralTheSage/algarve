<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $validated = $request->validate(['email-input' => ['required'], 'password-input' => ['required']]);

        $authenticated = Auth::attempt(
            [
                'email' => $validated['email-input'],
                'password' => $validated['password-input'],
            ]
        );

        if ($authenticated) {
            $request->session()->regenerate();

            return to_route('feed');
        }

        return redirect('/login')->with('fail', 'Incorrect Email or Password');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username-input' => ['required', 'unique:users,username', 'min:6', 'alpha_dash', 'max:25'],
            'email-input' => ['required', 'email', 'unique:users,email'],
            'password-input' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validated['username-input'][0] === '@') {
            $validated['username-input'] = substr($validated['username-input'], 1);
        }

        $user = User::create([
            'display_name' => $validated['username-input'],
            'username' => $validated['username-input'],
            'email' => $validated['email-input'],
            'password' => $validated['password-input'],
        ]);

        Auth::login($user);

        return to_route('feed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('feed');
    }
}
