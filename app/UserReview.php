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

    public static function getUserReviews($user_id){
        return self::where([
                ['maker_id', $user_id],
                ['writer', '<>', $user_id]])
            ->orWhere([
                ['fixer_id', $user_id],
                ['writer', '<>', $user_id]])
            ->paginate(5);
    }

    public static function getUserReviewCount($user_id){
        return self::where([
                ['maker_id', $user_id],
                ['writer', '<>', $user_id]])
            ->orWhere([
                ['fixer_id', $user_id],
                ['writer', '<>', $user_id]])
            ->count();
    }

    public static function getUserReviewScore($user_id){
        return self::where([
                ['maker_id', $user_id],
                ['writer', '<>', $user_id]])
            ->orWhere([
                ['fixer_id', $user_id],
                ['writer', '<>', $user_id]])
            ->avg('score');
    }
}
