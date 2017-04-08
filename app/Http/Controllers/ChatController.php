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
        return $match == null ? view('home') : view('chat.overview', ['chatChannel' => $chatName, 'messages' => $messages, 'user' => $chatPartner, 'conversationsLeft' => $conversationsLeft, 'conversationsRight' => $conversationsRight, 'firstConversation' => $firstConversation]);
    }

    public function postMessage(Request $request)
    {
        date_default_timezone_set('Europe/Brussels');
        // getting user information and the channel name from our blade
        $user = \App\User::getCurrentUser();
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
    }

    public function requestChat($id){
        $user = \Auth::user()->id;
        $conversation = Conversation::getSingleConversation($id);
        $chatName = $conversation["chatname"];
        $conversation["user_one"] == $user ? $chatPartner = \App\User::get($conversation["user_two"]) : $chatPartner = \App\User::get($conversation["user_one"]);
        return redirect('/chat/'.$chatName.'/'.str_slug($chatPartner));
    }

    public function startChat($chatName, $chatPartner){
        $user = \Auth::user()->id;
        $match = Conversation::matchConversationName($chatName);
        $messages = Message::getMessages($chatName);
        $conversationsLeft = Conversation::getUserConversationsLeft($user);
        $conversationsRight = Conversation::getUserConversationsRight($user);
        $firstConversation = Conversation::getSingleConversationByChatname($chatName);
        return $match == null ? view('home') : view('chat.overview', ['chatChannel' => $chatName, 'messages' => $messages, 'user' => $chatPartner, 'conversationsLeft' => $conversationsLeft, 'conversationsRight' => $conversationsRight, 'firstConversation' => $firstConversation]);
    }
}
