<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlussBlocks extends Model
{
    protected $fillable = [
        'kluss_id', 'blocker_id', 'block_reason'
    ];

    public $table = "kluss_blocks";

    public static function addBlock($task_id, $user_id, $reason){
        $exists = self::where([
            ['kluss_id', $task_id],
            ['blocker_id', $user_id]
        ])->first();

        if($exists == ""){
            $block = self::insert(['kluss_id' => $task_id, 'blocker_id' => $user_id, 'block_reason' => $reason]);
            $count = self::where([
                ['kluss_id', $task_id]
            ])->count();
            return $count >= 3 ? Kluss::BlockKluss($task_id) : true;
        }else{
            return true;
        }
    }
    public static function getUserBlock($task_id, $user_id){
        return self::where([
            ['kluss_id', $task_id],
            ['blocker_id', $user_id]
        ])->first();
    }
}
