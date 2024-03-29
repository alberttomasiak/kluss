<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon;
use App\User;

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
                        ])
                        ->orderBy('messages.created_at', 'asc')->get();
    }

    public static function getLastConversationMessages(){
        return self::whereIn('id', function($query){
            $query->selectRaw('max(id)')
            ->from('messages')
            ->orderBy('created_at', 'desc')
            ->groupBy('conversation_id');
        })
        ->get();
    }

    public static function formatDate($date){
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/y H:i:s');
    }

    public static function getSentMessagesCount(){
        return self::count();
    }

    public static function sendDefaultMessage($id){
        $chatUserID = 2;
        $chatID = Conversation::getConversationForDefaultUser($chatUserID, $id);
        $messageExists = self::where([
            ["user_id", "=", $chatUserID],
            ["conversation_id", "=", $chatID],
        ])->first();

        return $messageExists == "" ? self::insert(["message" => "Hey! Ik ben de contactpersoon van Kluss. Als je vragen hebt, kan je die gerust aan mij stellen.", "user_id" => $chatUserID, "conversation_id" => $chatID, "created_at" => Carbon\Carbon::now(), "updated_at" => Carbon\Carbon::now()]) : true;
    }

    public static function getUserUnreadMessages($user_id){
        return self::join('conversations', 'messages.conversation_id', '=', 'conversations.id')
                    ->select('messages.*')
                    ->where([
                        ['conversations.user_one', $user_id],
                        ['messages.is_seen', 0],
                        ['messages.user_id', '<>', $user_id]
                    ])
                    ->orWhere([
                        ['conversations.user_two', $user_id],
                        ['messages.is_seen', 0],
                        ['messages.user_id', '<>', $user_id]
                    ])->count();
    }

    public static function readUserMessages($user_id, $chat){
        $conversationID = Conversation::get($chat);
        return self::where([
            ['conversation_id', $conversationID],
            ['user_id', '<>', $user_id]])->update(['is_seen' => 1]);
    }

}
