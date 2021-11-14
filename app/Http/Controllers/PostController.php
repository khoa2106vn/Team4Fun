<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\NotifyParent;
use Illuminate\Http\Request;
use Snipe\BanBuilder\CensorWords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::latest()->with(['user', 'likes', 'comments'])->paginate(20);

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
        User::where('id', $request->user()->id)->update(['avatar' => $newImageName]);

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
        //THêm từ cấm
        $censor = new CensorWords;
        $langs = array('en-us', 'jp');
        $badwords = $censor->setDictionary($langs);

        $censor->setReplaceChar("*");
        $string = $censor->censorString($request->body);

        if ($string['clean'] != $request->body) {
            $string['clean'] = '(´｡• ω •｡`) ♡';
        }

        $post = $request->user()->posts()->create([
            'body' => $string['clean'],
            'image_path' => $newImageName,
        ]);

        $parentsemail = $post->user->parentsemail;
        if ($parentsemail != NULL) {
            Mail::to($parentsemail)->send(new NotifyParent(auth()->user(), $post));
        }
        return back();
    }

    public function edit(Request $request, $id)
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
        //THêm từ cấm
        $censor = new CensorWords;
        $langs = array('en-us', 'jp');
        $badwords = $censor->setDictionary($langs);

        $censor->setReplaceChar("*");
        $string = $censor->censorString($request->body);

        if ($string['clean'] != $request->body) {
            $string['clean'] = '(´｡• ω •｡`) ♡';
        }

        Post::find($id)->update([
            'body' => $string['clean'],
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


    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
