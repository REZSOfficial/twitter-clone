<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
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
        return view('messages.show', ['messages' => $messages, 'user_id' => $user_id, 'partner' => $partner, 'partner_id' => $partner_id]);
    }

    public function send(Request $request): JsonResponse
    {

        $receiver_id = $request['receiver_id'];
        $sender_id = $request['sender_id'];
        $message = $request['message'];

        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message_text' => $message
        ];

        $message = Message::create($data);

        return response()->json(['state' => 'success', 'message' => $message]);
    }
}
