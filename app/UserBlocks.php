<?php

namespace App;
use App\User;
use DB;

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
            ['blocked_id', '=', $blocked],
            ['archived', '0']
        ])->first();
    }

    public static function userReportCount(){
        return self::count();
    }

    public static function blockCounter($userID){
        return self::where('blocked_id', $userID)->count();
    }

    // Admin panel
    public static function getUserReportsByDate(){
        return DB::table('user_blocks')
                    ->join('users', 'user_blocks.blocked_id', 'users.id')
                    ->join('block_reasons', 'user_blocks.block_category', 'block_reasons.id')
                    ->select('user_blocks.*', 'users.*', 'block_reasons.*')
                    ->where('user_blocks.archived', '=', '0')
                    ->paginate(5);
    }
    public static function getArchivedReports(){
        return DB::table('user_blocks')
                    ->join('users', 'user_blocks.blocked_id', 'users.id')
                    ->join('block_reasons', 'user_blocks.block_category', 'block_reasons.id')
                    ->select('user_blocks.*', 'users.*', 'block_reasons.*')
                    ->where('user_blocks.archived', '=', '1')
                    ->paginate(5);
    }
    public static function archiveUserReports($userID){
        return self::where('blocked_id', '=', $userID)->update(['archived' => 1]);
    }

    public static function getUserBlocks($user_id){
        return self::join('users', 'user_blocks.blocked_id', '=', 'users.id')
                    ->select('users.name', 'user_blocks.*')
                    ->where([
                        ['blocker_id', $user_id],
                        ['archived', '0']])
                    ->paginate(10);
    }

    public static function archiveBlock($blocker, $blocked){
        return self::where([
            ['blocker_id', $blocker],
            ['blocked_id', $blocked]
        ])->update(['archived' => '1']);
    }
}
