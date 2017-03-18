<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_one', 'user_two', 'chatname'
    ];

    public $table = "conversations";

    public static function getSingleConversation($id){
        return self::whereIn('user_one', [$id, \Auth::user()->id])
                    ->whereIn('user_two', [$id, \Auth::user()->id])
                    ->first();
    }

    /*public static function getConversationID($name){
        return self::where("chatname", $name)->pluck("id")->get();
    }*/

    public static function getUserConversationsLeft($id){
        return self::join('users', 'conversations.user_one', '=', 'users.id')
                            ->select('conversations.*', 'users.*')
                            ->where('conversations.user_two', $id)
                            ->get();    
    }

    public static function getUserConversationsRight($id){
        return self::join('users', 'conversations.user_two', '=', 'users.id')
                            ->select('conversations.*', 'users.*')
                            ->where('conversations.user_one', $id)
                            ->get();
    }

    private static $lijst = [];

    public static function getConversationIDs(){
        return self::select("id", "chatname")->get()->pluck("id", "chatname")->toArray();
    }

    public static function get($key){
        if(empty(self::$lijst)){
            self::$lijst = Conversation::getConversationIDs();
        }
        if(!array_key_exists($key, self::$lijst)){
            return null;
        }
        return self::$lijst[$key];
    }

    public static function matchConversationName($name){
        return self::where('chatname', $name)->first();
    }
}
