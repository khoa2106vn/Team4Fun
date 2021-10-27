<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'body', 
    ];


    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($comment) {
            $comment->likes()->delete();
        });
    }
}
