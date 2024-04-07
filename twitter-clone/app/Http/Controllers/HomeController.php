<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Postlike;
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
        $user_likes = Postlike::where('user_id', Auth::user()->id)->pluck('post_id')->toArray();
        //$posts = Post::withCount('postcomments')->with('postcomments')->withCount('postlikes')->with('user')->get();
        $posts = Post::withCount('postcomments', 'postlikes') // Load counts of post comments and post likes
            ->with(['postcomments' => function ($query) {
                $query->with('user'); // Eager load the user associated with each post comment
            }])
            ->with('user') // Eager load the user who created each post
            ->get();
        return view('home', ['posts' => $posts, 'user_likes' => $user_likes]);
    }
}
