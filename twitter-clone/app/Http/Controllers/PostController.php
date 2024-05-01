<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Postcomment;
use App\Models\Postlike;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'text' => 'required|max:255',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        Post::create([
            "user_id" => Auth::user()->id,
            "text" => $request['text'],
            "img" => $imageName
        ]);

        return redirect('/home');
    }

    public function show($id)
    {
        return view('posts.create');
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function delete($id, Response $response): RedirectResponse
    {
        Postlike::where('post_id', $id)->delete();
        Postcomment::where('post_id', $id)->delete();
        Post::find($id)->delete();

        return redirect()->back();
    }
}
