<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable = [
        'maker_id', 'fixer_id', 'kluss_id', 'score', 'review', 'writer'
    ];

    public $table = "user_reviews";

    public static function writeReview($maker, $fixer, $task, $review, $score, $writer){
        return self::insert(['maker_id' => $maker, 'fixer_id' => $fixer, 'kluss_id' => $task, 'review' => $review, 'score' => $score, 'writer' => $writer]);
    }

    public static function reviewExists($task_id, $user){
        return self::where([
            ['kluss_id', $task_id],
            ['writer', $user]
            ])->first();
    }
}
