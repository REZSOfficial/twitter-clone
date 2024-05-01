<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public static function follow(int $id, Request $request): RedirectResponse
    {
        Follow::create(['follower' => Auth::user()->id, 'followed' => $id]);

        return redirect()->back();
    }

    public static function unfollow(int $id, Request $request): RedirectResponse
    {
        Follow::where('follower', Auth::user()->id)->where('followed', $id)->delete();

        return redirect()->back();
    }
}
