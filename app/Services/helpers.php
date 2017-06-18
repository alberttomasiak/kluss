<?php

if(!function_exists("spillvalue")){
    function spillvalue($key){
        return \App\GlobalSettings::get($key);
    }
}
if(!function_exists('areWeCool')){
    function areWeCool($user_1, $user_2){
        return \App\UserBlocks::areWeCool($user_1, $user_2);
    }
}
if(!function_exists('ChatParticipators')){
    function ChatParticipators($channel){
        return \App\Conversation::getSingleConversationByChatname($channel);
    }
}
if(!function_exists('goldEnd')){
    function goldEnd($user_id){
        return \App\GoldStatus::getGoldEnd($user_id);
    }
}
if(!function_exists('didIMark')){
    function didIMark($user_id, $task_id){
        return \App\KlussFinished::getUserTaskMarker($user_id, $task_id);
    }
}
if(!function_exists('userNameGet')){
    function userNameGet($id){
        return \App\User::get($id);
    }
}
if(!function_exists('blockChecker')){
    function blockChecker($task_id, $user_id){
        return \App\KlussBlocks::getUserBlock($task_id, $user_id);
    }
}
if(!function_exists('checkMsgs')){
    function checkMsgs($user_id){
        return \App\Message::getUserUnreadMessages($user_id);
    }
}
if(!function_exists('checkNtfs')){
    function checkNtfs($user_id){
        return \App\Notifications::getUserUnreadNotifications($user_id);
    }
}

if(!function_exists('timeAgo')){
    function timeAgo($dateTime){
        return \App\Kluss::convertToTimeAgo($dateTime);
    }
}

if(!function_exists('taskTitle')){
    function taskTitle($id){
        return \App\Kluss::getSingleTitle($id);
    }
}

if(!function_exists('classActivePath')){
    function classActivePath($path){
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p){
            if((request()->segment($segment) == $p) == false){
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if(!function_exists('checkAccountType')){
    function checkAccountType($id){
        return \App\User::checkAccountType($id);
    }
}

if(!function_exists('didIPay')){
    function didIPay($id){
        return \App\KlussPay::getPaidStatus($id);
    }
}

if(!function_exists('klussCategory')){
    function klussCategory($id){
        return \App\KlussCategories::IDToName($id);
    }
}
