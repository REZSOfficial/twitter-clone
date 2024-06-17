<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Postlike;
use Illuminate\View\View;
use App\Models\Postcomment;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'text' => 'required|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = null;
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
        }

        Post::create([
            "user_id" => Auth::user()->id,
            "text" => $request['text'],
            "img" => $imageName
        ]);

        return redirect('/home');
    }


    public function create(): View
    {
        return view('posts.create');
    }

    public function delete($id): RedirectResponse
    {
        $post = Post::find($id);

        $imageName = $post->img;

        $imagePath = public_path('images') . '/' . $imageName;

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        Postlike::where('post_id', $id)->delete();
        Postcomment::where('post_id', $id)->delete();
        $post->delete();

        return redirect()->back();
    }
}
