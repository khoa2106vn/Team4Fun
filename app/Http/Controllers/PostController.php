<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::latest()->with(['user', 'likes','comments'])->paginate(20);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function storeAvatar(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,png,jpeg,gif|max:10096',
        ]);
        $newImageName = NULL;
        if ($request->has('image')) {
            $newImageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $newImageName);
        }
        User::where ('id',$request->user()->id)->update(['avatar' => $newImageName]);




        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'image' => 'mimes:jpg,png,jpeg,gif|max:10096',
        ]);
        $newImageName = NULL;
        if ($request->has('image')) {
            $newImageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $newImageName);
        }
        $request->user()->posts()->create([
            'body' => $request->body,
            'image_path' => $newImageName,
        ]);

        return back();
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();
        return back();
    }
}
