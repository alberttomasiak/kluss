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
        return self::insert(['user_id' => $user_id, 'kluss_id' => $task_id]);
    }
}
