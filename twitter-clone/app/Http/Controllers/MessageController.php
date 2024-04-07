<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


    public function show(Request $request): View
    {
        $user_id = $request->query('user_id');
        $partner_id = $request->query('sender_id');
        $partner = User::find($partner_id);
        $messages = Message::where(function ($query) use ($user_id, $partner_id) {
            $query->where('sender_id', $user_id)
                ->where('receiver_id', $partner_id);
        })->orWhere(function ($query) use ($user_id, $partner_id) {
            $query->where('sender_id', $partner_id)
                ->where('receiver_id', $user_id);
        })->get();
        return view('messages.show', ['messages' => $messages, 'user_id' => $user_id, 'partner' => $partner]);
    }
}
