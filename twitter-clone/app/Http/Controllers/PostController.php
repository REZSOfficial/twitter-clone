<?php

namespace App\Http\Controllers;


use App\Models\Post;
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
}
