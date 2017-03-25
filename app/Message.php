<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon;

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

    public static function formatDate($date){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/y H:i:s');
    }
}
