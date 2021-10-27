<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 
    ];


    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function commentedBy(Comment $comment){
        return $this->comments->contains('comment_id', $comment->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');;
    }


    public function likes(){
        return $this->hasMany(Like::class);
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($post) {
            $post->likes()->delete();
        });
        static::deleting(function($post) {
            $post->comments()->delete();
        });
    }
}