<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class UserBlocks extends Model
{
    protected $fillable = [
        'blocker_id', 'blocked_id', 'block_category', 'block_reason'
    ];

    public $table = "user_blocks";

    // Our functions
}
