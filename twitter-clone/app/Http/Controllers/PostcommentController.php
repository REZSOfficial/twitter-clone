<?php

namespace App\Http\Controllers;

use App\Models\Postcomment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostcommentController extends Controller
{
    public function save(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
            'text' => 'required'
        ]);

        /*$data = [
            'post_id' => $request['post_id'],
            'user_id' => $request['user_id'],
            'text' => $request['text'],
        ];*/

        Postcomment::create($data);

        return response()->json(['success' => true]);
    }
}
