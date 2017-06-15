<?php

if(!function_exists("spillvalue")){
    function spillvalue($key){
        return \App\GlobalSettings::get($key);
    }
    function timeAgo($dateTime){
        return \App\Kluss::convertToTimeAgo($dateTime);
    }
    function taskTitle($id){
        return \App\Kluss::getSingleTitle($id);
    }
    function areWeCool($user_1, $user_2){
        return \App\UserBlocks::areWeCool($user_1, $user_2);
    }
    function ChatParticipators($channel){
        return \App\Conversation::getSingleConversationByChatname($channel);
    }
    function goldEnd($user_id){
        return \App\GoldStatus::getGoldEnd($user_id);
    }
    function didIMark($user_id, $task_id){
        return \App\KlussFinished::getUserTaskMarker($user_id, $task_id);
    }
    function userNameGet($id){
        return \App\User::get($id);
    }
    function blockChecker($task_id, $user_id){
        return \App\KlussBlocks::getUserBlock($task_id, $user_id);
    }
}
