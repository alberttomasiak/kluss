<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kluss extends Model
{
    //
    protected $fillable = [
            'title', 'description', 'kluss_image', 'price', 'date', 'latitude', 'longitude', 'user_id', 'accepted', 'address'
    ];

    public $table = "kluss";

    public static function getPublished(){
        return self::where('accepted', '=', '0')->get();
    }

    public static function getSingle($id){
        return self::where('id', '=', $id)->get();
    }

    public static function getSingleTitle($id){
        return self::where('id', '=', $id)->value('title');
    }

    public static function getUserKluss($id){
        return self::where('user_id', '=', $id)->get();
    }

    public static function getTasksInNeighborhood($lat, $lng){
        return DB::select(DB::raw(" SELECT *, (
		            6371 * acos (
            		cos (radians(". $lat .") )
            		* cos ( radians(kluss.latitude) )
            		* cos ( radians(kluss.longitude) - radians(". $lng .") )
            		+ sin ( radians(". $lat .") )
            		* sin ( radians( kluss.latitude ) )
            		)
               ) AS distance
               FROM kluss
               HAVING distance < 2.5
               ORDER BY distance;"));
    }
}
