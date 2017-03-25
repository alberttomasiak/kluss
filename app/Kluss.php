<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kluss extends Model
{
    //
    protected $fillable = [
            'title', 'description', 'kluss_image', 'price', 'date', 'latitude', 'longitude', 'user_id', 'accepted', 'address'
    ];

    public static function getPublished(){
        return self::where('accepted', '=', '0')->get();
    }

    public static function getSingle($id){
        return self::where('id', '=', $id)->get();
    }

    public static function getSingleTitle($id){
        return self::where('id', '=', $id)->value('title');
    }
}
