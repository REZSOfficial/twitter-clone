<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Postlike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view($id)
    {
        $user = User::find($id);
        $post_count = Post::where('user_id', $id)->count();
        $user_likes = Postlike::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();

        $posts = Post::withCount('postcomments', 'postlikes')
            ->with(['postcomments' => function ($query) {
                $query->with('user');
            }])
            ->with('user')
            ->where('user_id', $id)
            ->get();

        return view('users.view', ['posts' => $posts, 'user_likes' => $user_likes, 'user' => $user, 'post_count' => $post_count]);
    }

    public function changeusername(Request $request)
    {
        $user = User::find($request['id']);
        $data = $request->validate([
            'username' => 'required'
        ]);

        $user->update(['username' => $request->input('username')]);
    }
}
