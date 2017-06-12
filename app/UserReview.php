<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable = [
        'maker_id', 'fixer_id', 'kluss_id', 'score', 'review'
    ];

    public $table = "user_reviews";
}
