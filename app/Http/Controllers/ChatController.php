<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use App\User;

class ChatController extends Controller
{
    var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
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

    public function getIndex()
    {
        if(!$this->user)
        {
            $this->user = \App\User::getCurrentUser();
        }

        return view('chat.index', ['chatChannel' => $this->chatChannel]);
    }

    public function postMessage(Request $request)
    {
        $user = \App\User::getCurrentUser();
        $message = [
            'text' => e($request->input('chat_text')),
            'username' => $user->name,
            'avatar' => $user->profile_pic,
            'timestamp' => (time()*1000)
        ];
        $this->pusher->trigger($this->chatChannel, 'new-message', $message);
    }
}
