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

class ChatController extends Controller
{
    var $pusher;
    var $user;
    //var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

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
        $chatname = Hashids::encode(\Auth::user()->id, $id);
        $user = str_slug($target);

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
        $match = Conversation::matchConversationName($chatname);
        //$this->chatChannel = $name;
        return $match == null ? redirect()->back() : view('chat.index', ['chatChannel' => $chatname]);
    }

    public function postMessage(Request $request)
    {
        $user = \App\User::getCurrentUser();
        $chatChannel = e($request->chatChannel);
        //$conversationID = Conversation::getConversationID($chatChannel);

        $message = [
            'text' => e($request->input('chat_text')),
            'username' => $user->name,
            'avatar' => $user->profile_pic,
            'timestamp' => (time()*1000)
        ];

        /*$sent_message = new Message();
        $sent_message->$message = $message->text;
        $sent_message->user_id = \Auth::user()->id;
        $sent_message->conversation_id =*/

        $this->pusher->trigger($chatChannel, 'new-message', $message);
    }
}
