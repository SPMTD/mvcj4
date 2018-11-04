<?php
namespace App\Http\Controllers;

use App\Post;
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
}