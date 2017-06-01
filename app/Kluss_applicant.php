<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kluss_applicant extends Model
{
    public $table = "kluss_applicants";

    protected $fillable = [
        'kluss_id', 'user_id'
    ];

    public static function getApplicant($id){
        return self::where([
            ['kluss_id', '=', $id],
            ['user_id', '=', \Auth::user()->id],
            ])->get();
    }

    public static function getApplicants($id){
        return self::join('users', 'kluss_applicants.user_id', '=', 'users.id')
                    ->join('kluss', 'kluss_applicants.kluss_id', '=', 'kluss.id')
                    ->select('kluss_applicants.*', 'users.id', 'users.profile_pic', 'users.name')
                    ->where('kluss.user_id', '=', $id)->orderBy('date', 'asc')->paginate(5, ['*'], 'sollicitanten');
    }

    public static function getAllApplicants($id){
        return self::join('users', 'kluss_applicants.user_id', '=', 'users.id')
                    ->select('kluss_applicants.*', 'users.*')
                    ->where('kluss_applicants.kluss_id', '=', $id)
                    ->paginate(5, ['*'], 'sollicitanten');
    }

    public static function removeApplicant($taskID, $userID){
        return self::where([
            ['kluss_id', $taskID],
            ['user_id', $userID],
            ])->delete();
    }

    public static function getAcceptedApplicant($taskID){
        return self::join('users', 'kluss_applicants.user_id', '=', 'users.id')
                    ->select('kluss_applicants.*', 'users.*')
                    ->where([
                        ['kluss_id', $taskID],
                        ['accepted', 1]
                    ])->first();
    }

    public static function acceptApplicant($taskID, $userID){
        return self::where([
            ['kluss_id', $taskID],
            ['user_id', $userID]
        ])->update(['accepted' => 1]);
    }

    public static function deleteNotAcceptedApplicants($taskID){
        return self::where([
            ['kluss_id', $taskID],
            ['accepted', 0]
        ])->delete();
    }

    public static function getApplicantTableID($taskID, $userID){
        return self::where([
            ['kluss_id', $taskID],
            ['user_id', $userID]
        ])->pluck('id')->first();
    }

    public static function removeApplication($id){
        return self::where([
            ['kluss_id', '=', $id],
            ['user_id', '=', \Auth::user()->id],
            ])->delete();
    }

    public static function insertApplicant($id){
        return self::insert(
            ['kluss_id' => $id, 'user_id' => \Auth::user()->id]
        );
    }
}
