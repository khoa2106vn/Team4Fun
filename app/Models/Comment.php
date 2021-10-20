<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 
    ];


    public function likedBy(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    protected static function boot() {
        parent::boot();
    
        static::deleting(function($comment) {
            $comment->likes()->delete();
        });
    }
}
