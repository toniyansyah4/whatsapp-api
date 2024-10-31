<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Models\Chatroom;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Chatroom $chatroom, MessageRequest $request)
    {

        $message = $chatroom->messages()->create([
            'user_id' => $request->user_id,
            'message' => $request->message,
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
            $message->attachments()->create(['file_path' => $path]);
        }

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message, 201);
    }

    public function index(Chatroom $chatroom)
    {
        return $chatroom->messages()->with('attachments')->get();
    }
}
