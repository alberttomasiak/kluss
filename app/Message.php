<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
            "message", "user_id", "conversation_id", "is_seen"
    ];

    public static function getMessages($channel){
        $conversationID = Conversation::get($channel);
        return self::join('users', 'messages.user_id', '=', 'users.id')
                        ->select('users.*', 'messages.*')
                        ->where([
                            ["messages.conversation_id", '=',  $conversationID]
                        ])->get();
    }
}
