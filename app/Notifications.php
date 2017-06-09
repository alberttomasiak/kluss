<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'id', 'user_id', 'message', 'url', 'read', 'date'
    ];

    public $table = "user_notifications";
}
