<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockReasons extends Model
{
    protected $fillable = [
        'name'
    ];

    public $table = "block_reasons";

    public static function getCategories(){
        return self::get();
    }
}
