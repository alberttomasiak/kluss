<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kluss extends Model
{
    //
    protected $fillable = [
            'title', 'description', 'kluss_image', 'price', 'date', 'latitude', 'longitude', 'user_id', 'accepted_applicant_id', 'address'
    ];

    public $table = "kluss";

    public static function getPublished(){
        //return self::where('closed', '=', '0')->get();
        return DB::table('kluss')
                    ->join('users', 'kluss.user_id', '=', 'users.id')
                    ->select('kluss.*', 'users.account_type')
                    ->where('kluss.closed', '=', 0)
                    ->get();
    }

    public static function getSingle($id){
        //return self::where('id', '=', $id)->get();
        return DB::table('kluss')
                    ->join('users', 'kluss.user_id', '=', 'users.id')
                    ->select('kluss.*', 'users.account_type')
                    ->where('kluss.id', '=', $id)
                    ->get();
    }

    public static function getSingleTitle($id){
        return self::where('id', '=', $id)->value('title');
    }

    public static function getUserKluss($id){
        return self::where('user_id', '=', $id)->paginate(6);
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
               HAVING distance < 2
               ORDER BY distance;"));
    }

    public static function getActiveTaskCount(){
        return self::where('accepted_applicant_id', '=', '0')->count();
    }

    public static function getClosedTaskCount(){
        return self::where('closed', '=', '1')->count();
    }

    public static function getOpenTasks(){
        return self::where('accepted_applicant_id', '=', '0')->paginate(6);
    }
    public static function getClosedTasks(){
        return self::where('closed', '=', '1')->paginate(6);
    }

    public static function acceptUser($taskID, $applicantID){
        return self::where([
            ['id', $taskID]
        ])->update(['accepted_applicant_id' => $applicantID]);
    }
}
