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
                    ->get();
    }
}
