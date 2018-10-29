<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller 
{
    public function getWelcome() {
        $posts = Post::all();
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
            $message = 'Ur image has been uploaded!';
        }
        return redirect()->route('welcome')->with(['message' => $message]);
    }
}