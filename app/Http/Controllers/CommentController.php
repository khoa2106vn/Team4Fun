<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->posts()->comments()->create([ 
            'body' => $request->body,
            'user_id'=> $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Comment $comment){

        $this->authorize('delete', $comment);

        $comment->delete();
        return back();
    }
}
