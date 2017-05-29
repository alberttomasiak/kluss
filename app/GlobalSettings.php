<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    protected $fillable = [
        "key", "value"
    ];

    public $table = "global_settings";

    private static $lijst = [];

    public static function SettingsValueList(){
        return self::select("key","value")->get()->pluck("value", "key")->toArray();
    }

    public static function get($key){
        if(empty(self::$lijst)){
            self::$lijst = GlobalSettings::SettingsValueList();
        }
        if(!array_key_exists($key, self::$lijst)){
            return null;
        }
        return self::$lijst[$key];
    }

    public static function getSettings(){
        return self::paginate(10);
    }
}
