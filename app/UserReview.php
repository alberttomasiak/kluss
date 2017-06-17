<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserReview extends Model
{
    protected $fillable = [
        'maker_id', 'fixer_id', 'kluss_id', 'score', 'review', 'writer', 'created_at'
    ];

    public $table = "user_reviews";

    public static function writeReview($maker, $fixer, $task, $review, $score, $writer){
        $date = Carbon::now();
        return self::insert(['maker_id' => $maker, 'fixer_id' => $fixer, 'kluss_id' => $task, 'review' => $review, 'score' => $score, 'writer' => $writer, 'created_at' => $date]);
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
