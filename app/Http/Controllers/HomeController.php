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
use App\Mail\ReviewMail;

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

    public function testIndex(){
        $reviewtasks = Kluss::getTasksForReview();
        return view('test', compact('reviewtasks', $reviewtasks));
    }

    public function test(){
        $reviewtasks = Kluss::getTasksForReview();
        //$about_user, $for_user, $message, $url, $channel, $type, $kluss_id
        foreach($reviewtasks as $reviewtask){
            // notification to maker
            $channelMaker = User::getUserNotificationsChannel($reviewtask->user_id);
            $fixerName = User::get($reviewtask->accepted_applicant_id);
            $aboutMaker = $reviewtask->accepted_applicant_id;
            $forMaker = $reviewtask->user_id;
            $messageMaker = "Uw klusje werd gisteren uitgevoerd door ".$fixerName.". Gelieve deze persoon een review te geven.";
            $urlMaker = "/review/".$reviewtask->id;
            $typeMaker = "global";
            $klussID = $reviewtask->id;
            $this->pusher->trigger($channelMaker, "new-notification", $messageMaker);
            // notification to fixer
            $channelFixer = User::getUserNotificationsChannel($reviewtask->accepted_applicant_id);
            $makerName = User::get($reviewtask->user_id);
            $aboutFixer = $reviewtask->user_id;
            $forFixer = $reviewtask->accepted_applicant_id;
            $messageFixer = "Je hebt gisteren een klusje uitgevoerd voor ".$makerName.". Gelieve over deze persoon een review te schrijven.";
            $this->pusher->trigger($channelFixer, "new-notification", $messageFixer);
            // Database notifications for both
            $notificationMaker = Notifications::createNotification($aboutMaker, $forMaker, $messageMaker, $urlMaker, $channelMaker, $typeMaker, $klussID);
            $notificationFixer = Notifications::createNotification($aboutFixer, $forFixer, $messageFixer, $urlMaker, $channelFixer, $typeMaker, $klussID);
            // Emails to both
            $addressMaker = User::getUserMail($reviewtask->user_id);
            $addressFixer = User::getUserMail($reviewtask->accepted_applicant_id);
            $mailMaker = Mail::to($addressMaker)->send(new ReviewMail($makerName, $fixerName));;
            $mailFixer = Mail::to($addressFixer)->send(new ReviewMail($fixerName, $makerName));;
            // Closing the task
            $close = Kluss::closeTask($reviewtask->id);
        }
        return view('test', compact('reviewtasks', $reviewtasks));
    }

    public function notificationsIndex(){
        $notifications = Notifications::getUserNotifications(\Auth::user()->id);
        return view('meldingen', compact('notifications', $notifications));
    }
}
