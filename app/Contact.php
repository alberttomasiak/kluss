<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'name_company', 'category', 'email', 'subject', 'message'
    ];

    public $table = "contact_requests";

    public static function sendContact($name_company, $category, $email, $subject, $message){
        return self::insert([
            'name_company' => $name_company, 'category' => $category, 'email' => $email, 'subject' => $subject, 'message' => $message
        ]);

    }

    public static function get($id){
        return self::where('id', $id)->first();
    }

    public static function deleteContact($id){
        return self::where('id', $id)->delete();
    }
}
