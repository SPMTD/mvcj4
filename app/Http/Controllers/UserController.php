<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller {
    
    public function getSettings()
    {
        return view('settings', ['user' => Auth::user()]);
    }

    public function postSaveSettings(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();
        

        $file = $request->file('image');
        $filename = $request->file('image')->getClientOriginalName();
        $filenameEdit = $user->id . '_' . $filename;
        if($file) {
            Storage::disk('local')->put($filenameEdit, File::get($file));
        }
        
        return redirect()->route('settings');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function getAdminPage()
    {
        if(Auth::user()->role == "2") {

            $posts = Post::orderBy('created_at', 'desc')->get();

            return view('admin', ['posts' => $posts]);
            
        } else {
            return redirect('/');
        }
    }

    public function adminOnOff(Request $request)
    {
        $post = Post::find($request['postId']);
        $post->onOff = $request['onOff'];
        
        $post->update();
    }
}