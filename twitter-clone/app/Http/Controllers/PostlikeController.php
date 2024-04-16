<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Postlike;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostlikeController extends Controller
{
    public function add_like(Post $post, Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required',
            'user_id' => [
                'required',
                Rule::unique('postlikes')->where(
                    function ($query) use ($request) {
                        return $query->where('post_id', $request->post_id);
                    }
                )
            ]
        ]);

        $like = Postlike::create($data);

        return response()->json(['success' => true]);
    }

    public function remove_like(Post $post, Request $request)
    {
        Postlike::where('post_id', $request['post_id'])->where('user_id', $request['user_id'])->delete();

        return response()->json(['success' => true]);
    }
}
