<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlussFinished extends Model
{
    protected $fillable = [
        'maker_id', 'fixer_id', 'kluss_id'
    ];

    public $table = "kluss_finished";

    // functions
    public static function markAsFinished($user_id, $task_id){
        $getMarker = KlussFinished::getUserTaskMarker($user_id, $task_id);
        if($getMarker == ""){
            return self::insert(['user_id' => $user_id, 'kluss_id' => $task_id]);
        }else{
            return true;
        }
    }
    public static function getTaskMarks($task_id){
        return self::where('kluss_id', $task_id)->count();
    }
    public static function getTaskMarksFull($task_id){
        return self::where('kluss_id', $task_id)->get();
    }
    public static function getUserTaskMarker($user_id, $task_id){
        return self::where([
            ['user_id', $user_id],
            ['kluss_id', $task_id]])->first();
    }
}
