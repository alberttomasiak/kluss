<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notifications extends Model
{
    protected $fillable = [
        'id', 'user_id', 'message', 'url', 'read', 'date', 'channel', 'type', 'kluss_id'
    ];

    public $table = "user_notifications";

    public static function createNotification($about_user, $for_user, $message, $url, $channel, $type, $kluss_id){
        $date = Carbon::now()->toDateTimeString();
        return self::insert(['about_user' => $about_user, 'for_user' => $for_user, 'message' => $message, 'url' => $url, 'date' => $date, 'channel' => $channel, 'type' => $type, 'kluss_id' => $kluss_id]);
    }

    public static function getAllAdminNotifications(){
        return self::where('channel', 'global-notifications')
                    ->orWhere('about_user', '1')
                    ->paginate(5);
    }

    public static function getUserNotifications($user_id){
        return self::join('users', 'user_notifications.for_user', '=', 'users.id')
                    ->select('user_notifications.*', 'users.name', 'users.profile_pic')
                    ->where('user_notifications.for_user', $user_id)
                    ->paginate(5);
    }
}
