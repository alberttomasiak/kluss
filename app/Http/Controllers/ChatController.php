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
    public function requestChat($id)
    {
        // generating the array of our users
        $users = [$id, \Auth::user()->id];
        // checking if a conversation with our ID already exists
        $chatroom = Conversation::getSingleConversation($id);
        // getting our partner's data
        $target = User::get($id);
        // encoding the chat id for security purposes
        $chatname = Hashids::encode(\Auth::user()->id, $id);
        //slugging the other person's name for URL readability
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

    public function index(){
        // grabbing all conversations the user has.
        $user = \Auth::user()->id;
        $conversationsLeft = Conversation::getUserConversationsLeft($user);
        $conversationsRight = Conversation::getUserConversationsRight($user);
        $lastMessages = Message::getLastConversationMessages();
        return view('chat.home', compact('conversationsLeft', $conversationsLeft, 'conversationsRight', $conversationsRight, 'lastMessages', $lastMessages))->with('title', 'Chat geschiedenis');
    }

    public function startChatroom($chatname, $user){
        // checking if the conversation exists
        $match = Conversation::matchConversationName($chatname);
        // getting our chat partner's name
        $current_user = \Auth::user()->id;
        $data_partner = $current_user == $match["user_one"] ? User::getTargetInfo($match["user_two"]) : User::getTargetInfo($match["user_one"]);
        $partner_name = $data_partner[0]["name"];
        // grab all the messages for that specific conversation and send them to the channel.
        $messages = Message::getMessages($chatname);
        // if the conversation exists we send the user to it. If not, he gets sent back.
        return $match == null ? view('home') : view('chat.index', ['chatChannel' => $chatname, 'messages' => $messages, 'user' => $partner_name]);
    }

    public function postMessage(Request $request)
    {
        date_default_timezone_set('Europe/Brussels');
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

    public function overview(){
        $user = \Auth::user()->id;
        // $conversationsLeft = Conversation::getUserConversationsLeft($user);
        // $conversationsRight = Conversation::getUserConversationsRight($user);
        $firstConversation = Conversation::getFirstConversation($user);
        $chatName = $firstConversation["chatname"];
        //dd($chatName);
        $firstConversation["user_one"] == $user ? $chatPartner = \App\User::get($firstConversation["user_two"]) : $chatPartner = \App\User::get($firstConversation["user_one"]);
        return redirect('/chat/overview/'.$chatName.'/'.$chatPartner);
        //return view('chat.overview', compact(/*'conversationsLeft', $conversationsLeft, 'conversationsRight', $conversationsRight,*/ 'firstConversation', $firstConversation))->with('title', 'Chat overzicht');
    }

    public function chatOverviewUser($id){
        $user = \Auth::user()->id;
        dd($id);
        $conversation = Conversation::getSingleConversation($id);
        $chatName = $conversation["chatname"];
        $conversation["user_one"] == $user ? $chatPartner = \App\User::get($conversation["user_two"]) : $chatPartner = \App\User::get($conversation["user_one"]);
        //dd($chatName);
        return redirect('/chat/overview/'.$chatName.'/'.$chatPartner);
    }

    public function chatOverview($chatName, $chatPartner){
        // checking if the conversation exists
        $match = Conversation::matchConversationName($chatName);
        // getting our chat partner's name
        $current_user = \Auth::user()->id;
        $data_partner = $current_user == $match["user_one"] ? User::getTargetInfo($match["user_two"]) : User::getTargetInfo($match["user_one"]);
        $partner_name = $data_partner[0]["name"];
        // grab all the messages for that specific conversation and send them to the channel.
        $messages = Message::getMessages($chatName);
        // if the conversation exists we send the user to it. If not, he gets sent back.
        $conversationsLeft = Conversation::getUserConversationsLeft($current_user);
        $conversationsRight = Conversation::getUserConversationsRight($current_user);
        $firstConversation = Conversation::getSingleConversationByChatname($chatName);
        return $match == null ? view('home') : view('chat.overview', ['chatChannel' => $chatName, 'messages' => $messages, 'user' => $partner_name, 'conversationsLeft' => $conversationsLeft, 'conversationsRight' => $conversationsRight, 'firstConversation' => $firstConversation]);
    }
}
