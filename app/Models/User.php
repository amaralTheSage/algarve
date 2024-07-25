<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_name',
        'username',
        'email',
        'password',
        'image',
        'bio'
    ];




    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followed_follower', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followed_follower', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function checkIfAlreadyFollows(User $user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }
    public function liked()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function commentsLiked()
    {
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }

    public function checkIfLikedPost(Post $post)
    {
        return $this->liked()->where('post_id', $post->id)->exists();
    }

    public function checkIfLikedComment(Comment $comment)
    {
        return $this->commentsLiked()->where('comment_id', $comment->id)->exists();
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }

        return "https://api.dicebear.com/9.x/micah/svg?seed={$this->username}";
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
