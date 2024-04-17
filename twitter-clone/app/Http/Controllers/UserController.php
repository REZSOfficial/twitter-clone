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

        if ($user->username === $request->input('username')) {
            return response()->json(['message' => 'Username did not change!'], 200);
        } else {
            $user->update(['username' => $request->input('username')]);
            return response()->json(['message' => 'Username updated successfully!'], 200);
        }
    }

    public function updateProfilePicture($id, Request $request)
    {
        $request->validate([
            'profilepicture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profilepicture')) {
            $imageName = time() . '.' . $request->file('profilepicture')->getClientOriginalExtension();
            $request->file('profilepicture')->move(public_path('images'), $imageName);

            // Update user's profile picture
            $user = User::find($id);
            if ($user) {
                $user->profilepicture = $imageName;
                $user->save();
                session()->flash('success', 'Profile picture updated successfully!');
            }
        }

        return redirect()->back();
    }
}
