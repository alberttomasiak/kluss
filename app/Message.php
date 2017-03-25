<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon;

class Message extends Model
{
    protected $fillable = [
            "message", "user_id", "conversation_id", "is_seen"
    ];

    public $table = "messages";

    public static function getMessages($channel){
        $conversationID = Conversation::get($channel);
        return self::join('users', 'messages.user_id', '=', 'users.id')
                        ->select('users.*', 'messages.*')
                        ->where([
                            ["messages.conversation_id", '=',  $conversationID]
                        ])->get();
    }

    public static function getLastConversationMessages(){
        // return self::select('id', 'conversation_id', 'user_id', 'message', 'created_at')
        //             ->where([
        //                 ['id', 'in', max(['id'])]
        //                 ])
        //             ->from('messages')
        //             ->groupBy('conversation_id')
        //             // ->groupBy('conversation_id')
        //             // ->orderBy('created_at', 'desc')
        //             // ->latest()
        //             ->get();
        return self::where(function($query){
            $query->select(max(['id']))
            ->from('messages')
            ->groupBy('conversation_id');
        })
        ->get();
    }

    public static function formatDate($date){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/y H:i:s');
    }
}
