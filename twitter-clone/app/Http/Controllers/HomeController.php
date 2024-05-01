<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Postlike;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $user_likes = Postlike::getUserLikes(Auth::user()->id);

        $posts = Post::withCount('postcomments', 'postlikes')
            ->with(['postcomments' => function ($query) {
                $query->with('user');
            }])
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $followed = User::getFollowed(Auth::user()->id);
        $followed_array = $followed->pluck('id')->toArray();

        return view('home', ['posts' => $posts, 'user_likes' => $user_likes, 'followed' => $followed, 'followed_array' => $followed_array]);
    }

    public function followed(): View
    {
        $user_likes = Postlike::getUserLikes(Auth::user()->id);

        $followed = User::getFollowed(Auth::user()->id);
        $followed_array = $followed->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $followed_array)->withCount('postcomments', 'postlikes')
            ->with(['postcomments' => function ($query) {
                $query->with('user');
            }])
            ->orderBy('created_at', 'asc')
            ->with('user')
            ->get();



        return view('home', ['posts' => $posts, 'user_likes' => $user_likes, 'followed' => $followed, 'followed_array' => $followed_array]);
    }
}
