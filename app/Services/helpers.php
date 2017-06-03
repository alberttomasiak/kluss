<?php

if(!function_exists("spillvalue")){
    function spillvalue($key){
        return \App\GlobalSettings::get($key);
    }
}
