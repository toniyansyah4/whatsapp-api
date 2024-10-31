<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatroomUser extends Model
{
    protected $table = 'chatroom_users';

    protected $fillable = ['chatroom_id', 'user_id'];

    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
