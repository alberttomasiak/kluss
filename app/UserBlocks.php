<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class UserBlocks extends Model
{
    protected $fillable = [
        'blocker_id', 'blocked_id', 'block_category', 'block_reason'
    ];

    public $table = "user_blocks";

    // Our functions
    public static function checkForBlocks($blocker, $blocked){
        return self::where([
            ['blocker_id', '=', $blocker],
            ['blocked_id', '=', $blocked]
        ])->first();
    }

    public static function userReportCount(){
        return self::count();
    }

    public static function blockCounter($userID){
        return self::where('blocked_id', $userID)->count();
    }
}
