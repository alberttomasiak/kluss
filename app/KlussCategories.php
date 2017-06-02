<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlussCategories extends Model
{
    protected $fillable = [
        "name"
    ];

    public $table = "kluss_categories";

    public static function getCategories(){
        return self::get();
    }
}
