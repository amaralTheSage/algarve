<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $followedByUser = Auth::user()->following()->pluck('followed_id');
                $followedByUser = [...$followedByUser, Auth::id()];
                $view->with('who_to_follow', User::whereNotIn('id', $followedByUser)->inRandomOrder()->paginate(5));
            } else {
                $view->with('who_to_follow', User::inRandomOrder()->paginate(5));  // REMEMBER TO CHANGE
            }
        });



        Gate::define('admin', function (User $user, $post) {
            return $user->is_admin;
        });

        Gate::define('owner', function (User $user, $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('owner_or_admin', function (User $user, $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });
    }
}
