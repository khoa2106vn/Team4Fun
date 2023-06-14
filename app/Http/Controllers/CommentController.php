<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Mail\NotifyParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function index(){

        $posts = Post::latest()->with(['user','likes'])->paginate(20);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request, Post $post){
        $this->validate($request, [
            'body' => 'required'
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['post_id'] = $request->input('post_id');
        Comment::create($input);
   
        $parentsemail = auth()->user()->parentsemail;
        if ($parentsemail != NULL) {
            Mail::to($parentsemail)->send(new NotifyParent(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Comment $comment, Request $request){

        // $this->authorize('delete', $comment);

        $request->user()->comments()->where('id', $comment->id)->delete();
        return back();

    }
}
