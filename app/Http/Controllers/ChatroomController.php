<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatroomCreateRequest;
use App\Http\Requests\ChatroomEnterRequest;
use App\Http\Requests\ChatroomLeaveRequest;
use App\Models\Chatroom;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    public function create(ChatroomCreateRequest $request)
    {
        $chatroom = Chatroom::create([
            'name' => $request->name,
            'max_members' => $request->max_members
        ]);
        return response()->json($chatroom, 201);
    }

    public function index(Request $request)
    {
        $query = Chatroom::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('max_members')) {
            $query->where('max_members', $request->input('max_members'));
        }

        $limit = $request->input('limit', 10); // Default limit is 10
        $page = $request->input('page', 1); // Default page is 1

        $query->skip(($page - 1) * $limit)->take($limit);

        $total = $query->count();
        $chatrooms = $query->get();
    
        $nextPage = $page < ceil($total / $limit) ? $page + 1 : null;
        $prevPage = $page > 1 ? $page - 1 : null;
    
        return response()->json([
            'data' => $chatrooms,
            'pagination' => [
            'total' => $total,
            'limit' => $limit,
            'current_page' => $page,
            'next_page' => $nextPage,
            'prev_page' => $prevPage,
            ],
        ], 200);


    }

    public function enter(Chatroom $chatroom, ChatroomEnterRequest $request)
    {
        $chatroom->users()->attach($request->user_id);
        return response()->json(['message' => 'User entered the chatroom'], 200);
    }

    public function leave(Chatroom $chatroom, ChatroomLeaveRequest $request)
    {
        $chatroom->users()->detach($request->user_id);
        return response()->json(['message' => 'User left the chatroom'], 200);
    }
}
