<?php

if(!function_exists("spillit")){
    function spillit($key){
        return \App\GlobalSettings::get($key);
    }
}
