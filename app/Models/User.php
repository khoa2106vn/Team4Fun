<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->posts()->delete();
        });
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function receivedLikes()
    {
        return $this->hasManyThrough(Like::class, Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //======================== functions to get friends attribute =========================

    // friendship that this user started
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // friendship that this user was asked for
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();
            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        if ($temp = $this->friendsOfThisUser)
            return $temp->merge($this->thisUserFriendOf);
        else
            return $this->thisUserFriendOf;
    }
    //======================== end functions to get friends attribute =========================

    //====================== functions to get blocked_friends attribute ============================

    // friendship that this user started but now blocked
    protected function friendsOfThisUserBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->wherePivot('acted_user', 'first_user');
    }

    // friendship that this user was asked for but now blocked
    protected function thisUserFriendOfBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->wherePivot('acted_user', 'second_user');
    }

    // accessor allowing you call $user->blocked_friends
    public function getBlockedFriendsAttribute()
    {
        if (!array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
        return $this->getRelation('blocked_friends');
    }

    protected function loadBlockedFriends()
    {
        if (!array_key_exists('blocked_friends', $this->relations)) {
            $friends = $this->mergeBlockedFriends();
            $this->setRelation('blocked_friends', $friends);
        }
    }

    protected function mergeBlockedFriends()
    {
        if ($temp = $this->friendsOfThisUserBlocked)
            return $temp->merge($this->thisUserFriendOfBlocked);
        else
            return $this->thisUserFriendOfBlocked;
    }
    // ======================================= end functions to get block_friends attribute =========

    public function friend_requests()
    {
        return $this->hasMany(Friendship::class, 'second_user')
            ->where('status', 'pending');
    }
}
