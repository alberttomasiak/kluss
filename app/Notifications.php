<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notifications extends Model
{
    protected $fillable = [
        'id', 'user_id', 'message', 'url', 'read', 'date'
    ];

    public $table = "user_notifications";

    public static function createNotification($about_user, $for_user, $message, $url, $channel){
        $date = Carbon::now()->toDateTimeString();
        return self::insert(['about_user' => $about_user, 'for_user' => $for_user, 'message' => $message, 'url' => $url, 'date' => $date, 'channel' => $channel]);
    }

    public static function getAllAdminNotifications(){
        return self::where('channel', 'global-notifications')
                    ->orWhere('about_user', '1')
                    ->paginate(5);
    }
}
