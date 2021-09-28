<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::paginate(20);
        $feeds = array();

        foreach ($posts as $post):
			array_unshift($feeds, $post);
        endforeach;

        return view('posts.index', [
            'posts' => $posts,
            'feeds' => $feeds,
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([ 
            'body' => $request->body
        ]);

        return back();
    }
}
