<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlussPay extends Model
{
    protected $fillable = [
        'task_id'
    ];

    public $table = "kluss_pay";

    public static function getPaidStatus($task_id){
        return self::where('task_id', $task_id)->first();
    }
    public static function addPayment($task_id){
        return self::insert(['task_id' => $task_id]);
    }
}
