<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    protected $fillable = [
        "key", "value"
    ];
    public $table = "global_settings";
}
