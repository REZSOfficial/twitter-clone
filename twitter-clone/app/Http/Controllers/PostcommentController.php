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

        Postcomment::create($data);

        return response()->json(['success' => true]);
    }
}
