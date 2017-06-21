<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App;

class Notifications extends Model
{
    var $pusher;

    protected $fillable = [
        'id', 'user_id', 'message', 'url', 'read', 'date', 'channel', 'type', 'kluss_id'
    ];

    public $table = "user_notifications";

    public static function createNotification($about_user, $for_user, $message, $url, $channel, $type, $kluss_id){
        $date = Carbon::now()->toDateTimeString();
        $data = ['about_user' => $about_user, 'for_user' => $for_user, 'message' => $message, 'url' => $url, 'date' => $date, 'channel' => $channel, 'type' => $type, 'kluss_id' => $kluss_id];
        return self::insert(['about_user' => $about_user, 'for_user' => $for_user, 'message' => $message, 'url' => $url, 'date' => $date, 'channel' => $channel, 'type' => $type, 'kluss_id' => $kluss_id]);
    }

    public static function getAllAdminNotifications(){
        return self::where('channel', 'global-notifications')
                    ->orWhere('about_user', '1')
                    ->paginate(5);
    }

    public static function getUserNotifications($user_id){
        return self::join('users', 'user_notifications.about_user', '=', 'users.id')
                    ->select('user_notifications.*', 'users.name', 'users.profile_pic')
                    ->where('user_notifications.for_user', $user_id)
                    ->orderBy('user_notifications.date', 'desc')
                    ->paginate(5);
    }

    public static function readUserNotifications($user_id){
        return self::where('for_user', $user_id)->update(['read' => 1]);
    }

    public static function getUserUnreadNotifications($user_id){
        return self::where([
            ['for_user', $user_id],
            ['read', '0']
        ])->count();
    }
}
