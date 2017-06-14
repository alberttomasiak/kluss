<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Vinkla\Hashids\Facades\Hashids;
use \Carbon;

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

    public static function getSingleConversationByChatname($chatname){
        return self::where('chatname', $chatname)->first();
    }

    public static function getFirstConversation($user){
        return self::where('user_one', $user)
                    ->orWhere('user_two', $user)
                    ->first();
    }

    public static function getUserConversationsLeft($id){
        return self::join('users', 'conversations.user_one', '=', 'users.id')
                            ->select('conversations.*', 'conversations.id as convid', 'users.*')
                            ->where('conversations.user_two', $id)
                            ->get();
    }

    public static function getUserConversationsRight($id){
        return self::join('users', 'conversations.user_two', '=', 'users.id')
                            ->select('conversations.*', 'conversations.id as convid', 'users.*')
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

    public static function getConversationsCounter(){
        return self::count();
    }

    public static function getConversationForDefaultUser($chat, $realUser){
        return self::where([
            ["user_one", "=", $chat],
            ["user_two", "=", $realUser],
        ])->pluck("id")->first();
    }

    public static function createConversation($id){
        $chatUserID = 2;
        $gesprek = self::where([
            ["user_one", '=', $chatUserID],
            ["user_two", '=', $id],
        ])->first();

        return $gesprek == "" ? self::insert(["user_one" => $chatUserID, "user_two" => $id, "chatname" => Hashids::encode($chatUserID, $id), "created_at" => Carbon\Carbon::now(), "updated_at" => Carbon\Carbon::now()]) : true;
    }
}
