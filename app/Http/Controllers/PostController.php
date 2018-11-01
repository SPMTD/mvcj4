<?php
namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Log;
use App\Http\Controllers\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{
    public function getWelcome() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('welcome', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:128',
            'filename' => 'required|image'
        ]);

        $post = new Post();
        $post->title = $request['title'];
        $post->filename = $request['filename'];

        $destinationPath = base_path('/storage/app/public');    
        $post->filename->move($destinationPath, $post->filename->getClientOriginalName());

        $post->filename = $post->filename->getClientOriginalName();

        $message = 'there was an error';
        
        $request->user()->posts()->save($post);
        if($request->user()->posts()->save($post)) {
            $message = 'Your post has been uploaded!';
        }
        return redirect()->route('welcome')->with(['message' => $message]);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if(Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->title = $request['title'];
        $post->update();
        return response()->json(['new_title' => $post->title ], 200);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('welcome')->with(['message' => 'Successfully deleted!']);
    }
}