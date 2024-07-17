<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('admin', function (User $user, Post $post) {
            return $user->is_admin;
        });

        Gate::define('owner', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('owner_or_admin', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->is_admin;
        });
    }
}
