<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use App\Kluss;
use App\User;
use DB;
use App\Conversation;
use App\Message;
use App;
use App\Notifications;
use App\GoldStatus;
use Carbon\Carbon;
use Mail;
use App\Mail\ExpirationGold;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     var $pusher;

    public function __construct()
    {
        $this->middleware('auth');
        $this->pusher = App::make('pusher');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klussjes = Kluss::getPublished();
        Conversation::createConversation(\Auth::user()->email);
        Message::sendDefaultMessage(\Auth::user()->email);
        $gold_end = GoldStatus::getGoldEnd(\Auth::user()->id);
        if($gold_end != null){
            $goldie = Carbon::parse($gold_end);
            $date1 = new Carbon();
            $diff = $date1->diffInDays($goldie);

            if($diff <= 10 && $diff > 0){
                // send notification to user + mail
                $user = \Auth::user()->id;
                $channel = User::getUserNotificationsChannel($user);
                $message = "Uw KLUSS Gold subscriptie verloopt in ".$diff." dagen.";
                $this->pusher->trigger($channel, "new-notification", $message);
                $notification = Notifications::createNotification($user, $user, $message, null, $channel, "global", null);
                // Mail
                $userMail = User::getUserMail($user);
                Mail::to($userMail)->send(new ExpirationGold($user->name, $diff));
            }
            if($diff <= 0){
                $user = \Auth::user()->id;
                $unGoldify = User::removeGoldFromUser($user);

                $channel = User::getUserNotificationsChannel($user);
                $message = "Uw KLUSS Gold subscriptie is verlopen.";
                $this->pusher->trigger($channel, "new-notification", $message);
                $notification = Notifications::createNotification($user, $user, $message, null, $channel, "global", null);
            }
        }
        return view('home', compact('klussjes', $klussjes));
    }

    public function getTasks(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $klusjes = Kluss::getTasksInNeighborhood($lat, $lng);
        return [$klusjes];
    }

    public function notificationsIndex(){
        $notifications = Notifications::getUserNotifications(\Auth::user()->id);
        return view('meldingen', compact('notifications', $notifications));
    }
}
