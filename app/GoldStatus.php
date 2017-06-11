<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GoldStatus extends Model
{
    protected $fillable = [
        'user_id', 'start_date', 'end_date',
    ];

    public $table = "gold_status";

    public static function createGoldUser($user_id, $start_date, $end_date){
        $exists = self::where('user_id', $user_id)->first();
        if($exists == ""){
            return self::insert(['user_id' => $user_id, 'start_date' => $start_date, 'end_date' => $end_date]);
        }else{
            return self::where('user_id', $user_id)->update(['start_date' => $start_date, 'end_date' => $end_date]);
        }
    }

    public static function getIDByUser($user_id){
        return self::where('user_id', $user_id)->pluck('id')->first();
    }

    public static function getGoldEnd($user_id){
        return self::where('user_id', $user_id)->pluck('end_date')->first();
    }

    public static function checkGoldStatus($user_id){
        $end = self::where('user_id', $user_id)->pluck('end_date')->first();
        if($end != ""){
            $now = Carbon::now();
            return $now < $end ? true : false;
        }
    }
}
