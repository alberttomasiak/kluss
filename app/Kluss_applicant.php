<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kluss_applicant extends Model
{
    public $table = "kluss_applicants";

    protected $fillable = [
        'kluss_id', 'user_id'
    ];

    public static function getApplicants($id){
        return self::where([
            ['kluss_id', '=', $id],
            ['user_id', '=', \Auth::user()->id],
            ])->get();
    }

    public static function deleteApplicant($id){
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
