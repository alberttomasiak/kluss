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

class ChatController extends Controller
{
    var $pusher;
    var $user;
    //var $chatChannel;
    // const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
        //$this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

    /*public function postAuth(Request $request)
    {
        if(!$this->user){
            $this->user = Session::get('user');
        }
        $channelName = e($request->input('channel_name'));
        $socket_id = e($request->socket_id);
        $auth = $this->pusher->socket_auth($channelName, $socketId);
        return !$this->user ? '401 Unauthorized' : $auth;
    }*/

    public function requestChat($id)
    {
        $users = [$id, \Auth::user()->id];
        $chatroom = Conversation::getSingleConversation($id);
        $target = User::get($id);
        //$toTiny = "private-".str_slug(\Auth::user()->name).\Auth::user()->id.str_slug($target).$id;
        // we generate a conversation chatroom bij hashing the ids of the two users.
        $chatname = Hashids::encode(\Auth::user()->id, $id);
        $user = str_slug($target);

        // if the chatroom between these two users doesn't exist, we make a new one.
        if($chatroom == null)
        {
            $chatroom = new Conversation();
            $chatroom->user_one = \Auth::user()->id;
            $chatroom->user_two = $id;
            $chatroom->chatname = $chatname;
            $chatroom->save();
        }
        return redirect()->to('chat/'. $chatroom->chatname.'/'.$user);
    }

    /*public function getIndex(Request $request, $name)
    {
        if(!$this->user)
        {
            $this->user = \App\User::getCurrentUser();
        }
        return view('chat.index', ['chatChannel' => $name]);
    }*/

    public function startChatroom($chatname, $user){
        // checking if the conversation exists
        $match = Conversation::matchConversationName($chatname);

        //$this->chatChannel = $name;
        //dd($match["user_one"]);
        // $current_user = \Auth::user()->id;
        // $data_partner = $current_user == $match["user_one"] ? User::getTargetInfo($match["user_two"]) : User::getTargetInfo($match["user_one"]);
        // $user_one_name = User::get($match["user_one"]);
        // $user_two_name = User::get($match["user_two"]);
        // $partner_name = Str::slug($data_partner[0]["name"]);
        // dd($partner_name);
        // if($user != Str::slug($user_one_name) || $user != Str::slug($user_two_name)){
        //     return $match == null ? redirect()->back() : $this->startChatroom($chatname, $partner_name);
        // }

        // grab all the messages for that specific conversation and send them to the channel.
        $messages = Message::getMessages($chatname);
        // if the conversation exists we send the user to it. If not, he gets sent back.
        return $match == null ? view('home') : view('chat.index', ['chatChannel' => $chatname, 'messages' => $messages]);
    }

    public function postMessage(Request $request)
    {
        // getting user information and the channel name from our blade
        $user = \App\User::getCurrentUser();
        $chatChannel = e($request->chatChannel);
        //$conversationID = Conversation::getConversationID($chatChannel);

        // creating the message, that we will send back to the view
        $message = [
            'text' => e($request->input('chat_text')),
            'username' => $user->name,
            'avatar' => $user->profile_pic,
            'timestamp' => (time()*1000)
        ];

        //dd(Conversation::getConversationID($chatChannel));
        // saving the message to the DB
        $sent_message = new Message();
        $sent_message->message = e($request->input('chat_text'));
        $sent_message->user_id = \Auth::user()->id;
        $sent_message->conversation_id = Conversation::get($chatChannel);
        $sent_message->save();

        // pushing the message back to our view
        $this->pusher->trigger($chatChannel, 'new-message', $message);
    }
}
