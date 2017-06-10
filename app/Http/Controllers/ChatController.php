<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User;
use App\Conversation;
use App\Message;
use App\Notifications;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Str;

/*
* Author Albert Tomasiak;
*/

class ChatController extends Controller
{
    var $pusher;
    var $user;

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
    }

    public function index(){
        $user = \Auth::user()->id;
        $firstConversation = Conversation::getFirstConversation($user);
        $chatName = $firstConversation["chatname"];
        $firstConversation["user_one"] == $user ? $chatPartner = \App\User::get($firstConversation["user_two"]) : $chatPartner = \App\User::get($firstConversation["user_one"]);
        // checking if the conversation exists
        $match = Conversation::matchConversationName($chatName);
        // getting our chat partner's name
        // grab all the messages for that specific conversation and send them to the channel.
        $messages = Message::getMessages($chatName);
        // if the conversation exists we send the user to it. If not, he gets sent back.
        $conversationsLeft = Conversation::getUserConversationsLeft($user);
        $conversationsRight = Conversation::getUserConversationsRight($user);
        $firstConversation = Conversation::getSingleConversationByChatname($chatName);
        return $match == null ? redirect('/home') : view('chat.overview', ['chatChannel' => $chatName, 'messages' => $messages, 'user' => $chatPartner, 'conversationsLeft' => $conversationsLeft, 'conversationsRight' => $conversationsRight, 'firstConversation' => $firstConversation]);
    }

    public function postMessage(Request $request)
    {
        date_default_timezone_set('Europe/Brussels');
        // getting user information and the channel name from our blade
        $user = User::getCurrentUser();
        $chatChannel = e($request->chatChannel);
        // creating the message, that we will send back to the view
        $message = [
            'text' => e($request->input('chat_text')),
            'username' => $user->name,
            'avatar' => $user->profile_pic,
            'timestamp' => (time()*1000)
        ];
        // saving the message to the DB
        $sent_message = new Message();
        $sent_message->message = e($request->input('chat_text'));
        $sent_message->user_id = \Auth::user()->id;
        $sent_message->conversation_id = Conversation::get($chatChannel);
        $sent_message->save();
        // pushing the message back to our view
        $this->pusher->trigger($chatChannel, 'new-message', $message);
        // notifying the user of an incoming message
        // about ==> sender, for ==> receiver, message = Naam: bericht, url = /kluss/ID, channel = accepted
        $conversation = Conversation::getSingleConversationByChatname($chatChannel);
        $conversation->user_one == \Auth::user()->id ? $for_user = $conversation->user_two : $for_user = $conversation->user_one;
        $partnerName = User::get($for_user);
        $about_user = \Auth::user()->id;
        $message = $sent_message->message;
        $url = "/chat/".$chatChannel."/".str_slug($partnerName);
        $channel = User::getUserNotificationsChannel($for_user);
        $type = "chat";
        // push notification + save in database
        $this->pusher->trigger($channel, "new-notification", $message);
        $notification = Notifications::createNotification($about_user, $for_user, $message, $url, $channel, $type, null);
    }

    public function requestChat($id){
        $user = \Auth::user()->id;
        $conversation = Conversation::getSingleConversation($id);
        if($conversation == null){
            $chatroom = new Conversation();
            //set name
            $chatroom->user_one = \Auth::user()->id;
            $chatroom->user_two = $id;
            $chatroom->chatname = Hashids::encode(\Auth::user()->id, $id);
            $chatroom->save();
            //add user 2
            $partner_name = User::get($id);
            return redirect('/chat/'.$chatroom->chatname.'/'.str_slug($partner_name));
        }else{
            $chatName = $conversation["chatname"];
            $conversation["user_one"] == $user ? $chatPartner = \App\User::get($conversation["user_two"]) : $chatPartner = \App\User::get($conversation["user_one"]);
            return redirect('/chat/'.$chatName.'/'.str_slug($chatPartner));
        }
    }

    public function startChat($chatName, $chatPartner){
        $user = \Auth::user()->id;
        $match = Conversation::matchConversationName($chatName);
        $messages = Message::getMessages($chatName);
        $conversationsLeft = Conversation::getUserConversationsLeft($user);
        $conversationsRight = Conversation::getUserConversationsRight($user);
        $firstConversation = Conversation::getSingleConversationByChatname($chatName);
        return $match == null ? redirect('/home') : view('chat.overview', ['chatChannel' => $chatName, 'messages' => $messages, 'user' => $chatPartner, 'conversationsLeft' => $conversationsLeft, 'conversationsRight' => $conversationsRight, 'firstConversation' => $firstConversation]);
    }
}
