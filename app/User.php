<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\VerificationMail;
use App\Mail\CtaMail;
use Mail;

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

    public static function sendVerificationMail($email){
        $code = User::getVerificationCode($email);
        $title = "Account verifiëren";
        $userName = User::getNameByEmail($email);
        $body = "Hey ".$userName."! Je hebt je onlangs geregistreerd op KLUSS.be. Uw account moet nog wel geverifiëerd worden.";
        $btnSource = "verificatie/".$code;
        $btnTitle = "Verifiëren";
        
        Mail::to($email)->send(new CtaMail($title, $body, $btnSource, $btnTitle));
        return true;
    }

    public static function getNameByEmail($email){
        return self::where('email', $email)->pluck('name')->first();
    }

    public static function verifyAccount($code){
        return self::where('activation_code', $code)->update(['activated' => 1]);
    }

    public static function generateVerificationCode($email){
        return self::where('email', $email)->update(['activation_code' => str_random(45)]);
    }

    public static function getVerificationCode($email){
        return self::where('email', $email)->pluck('activation_code')->first();
    }

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

    public static function checkAccountType($userID){
        return self::where('id', $userID)->pluck('account_type')->first();
    }

    public static function getByEmail($email){
        return self::where('email', $email)->get();
    }

    public static function getRegisteredUserCount(){
        // first option doesn't include admins :)
        //return self::where('account_type', '!=', 'admin')->count();
        return self::count();
    }


    // Ban related functions
    public static function BANHAMMER($foolsID){
        // Banhammer initiate
        return self::where('id', $foolsID)->update(['blocked' => 1]);
    }
    public static function amIBanned($email){
        return self::where('email', $email)->pluck('blocked')->first();
    }
    public static function unblockUser($userID){
        return self::where('id', $userID)->update(['blocked' => 0]);
    }

    // ADMIN FUNCTIONS
    // DASHBOARD
    public static function getGoldUserCount(){
        return self::where('account_type', '=', 'gold')->count();
    }

    public static function getVerifiedUserCount(){
        return self::where('verified', '=', '1')->count();
    }

    public static function getBlockedUserCount(){
        return self::where('blocked', '=', '1')->count();
    }

    public static function getIdByMail($mail){
        return self::where("email", $mail)->pluck("id")->first();
    }

    public static function getUserMail($id){
        return self::where("id", $id)->pluck("email")->first();
    }
    // USERS
    public static function getAdminUsers(){
        return self::where('account_type', 'admin')->paginate(5);
    }
    public static function getRegularUsers(){
        return self::where('account_type', '==', 'normal')->paginate(5);
    }
    public static function getGoldUsers(){
        return self::where('account_type', '==', 'gold')->paginate(5);
    }
    public static function getBlockedUsers(){
        return self::where('blocked', '=', '1')->paginate(5);
    }
}
