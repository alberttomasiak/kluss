<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_pic', 'bio', 'user_rating', 'account_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private static $lijst = [];

    public static function getCurrentUser(){
        return self::where("id", \Auth::user()->id)->first();
    }

    public static function getTargetInfo($id){
        return self::where("id", $id)->get();
    }

    public static function userNameList(){
        return self::select("id", "name")->get()->pluck("name", "id")->toArray();
    }

    public static function get($key){
        if(empty(self::$lijst)){
            self::$lijst = User::userNameList();
        }
        if(!array_key_exists($key, self::$lijst)){
            return null;
        }
        return self::$lijst[$key];
    }

    public static function is_admin($account_type){
        if($account_type == "admin"){
            return true;
        }else{
            return false;
        }
    }

    public static function getRegisteredUserCount(){
        return self::where('account_type', '!=', 'admin')->count();
    }

    public static function getGoldUserCount(){
        return self::where('account_type', '=', 'gold')->count();
    }
}
