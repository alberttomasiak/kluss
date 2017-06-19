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
use App\KlussFinished;

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
        $cards = Kluss::paginatePublished();
        Conversation::createConversation(\Auth::user()->id);
        Message::sendDefaultMessage(\Auth::user()->id);
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
        return view('home', compact('klussjes', 'cards'));
    }

    public function welcome(){
        $klussjes = Kluss::getPublished();
        return view('welcome', compact('klussjes'));
    }

    public function getTasks(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $klusjes = Kluss::getTasksInNeighborhood($lat, $lng);
        return [$klusjes];
    }

    public function taskReviews(){
        $reviewtasks = Kluss::getTasksForReview();
        //$about_user, $for_user, $message, $url, $channel, $type, $kluss_id
        foreach($reviewtasks as $reviewtask){
            $marks = KlussFinished::getTaskmarks($reviewtask->id);
            $marksFull = KlussFinished::getTaskMarksFull($reviewtask->id);
            $maker = $reviewtask->user_id;
            $channelMaker = User::getUserNotificationsChannel($maker);
            $nameMaker = User::get($maker);

            $fixer = $reviewtask->accepted_applicant_id;
            $channelFixer = User::getUserNotificationsChannel($fixer);
            $nameFixer = User::get($fixer);
            // contact info for notifications
            $type = "global";
            $url = "/kluss/".$reviewtask->id;
            $klussID = $reviewtask->id;
            if($marks > 0){
                foreach($marksFull as $markF){
                    $user = $markF->user_id;
                    if($user == $maker){
                        // the maker has marked the task as finished so we need to contact the fixer
                        $messageForFixer = $nameMaker." heeft het klusje '".$reviewtask->title."' sinds haar ontstaan gemarkeerd als afgesloten. Om het klusje definitief af te ronden moet deze nog afgesloten worden door jou. Klik op deze melding, of ga naar de pagina van het klusje om het klusje af te ronden.";
                        $notificationMaker = Notifications::createNotification($maker, $fixer, $messageForFixer, $url, $channelFixer, $type, $klussID);
                    }else{
                        // the fixer has marked --> let's contact the maker
                        $messageForMaker = $nameFixer." heeft het klusje '".$reviewtask->title."' sinds haar ontstaan gemarkeerd als afgesloten. Om het klusje definitief af te ronden moet deze nog afgesloten worden door jou. Klik op deze melding, of ga naar de pagina van het klusje om het klusje af te ronden.";
                        $notificationFixer = Notifications::createNotification($fixer, $maker, $messageForMaker, $url, $channelMaker, $type, $klussID);
                    }
                }
            }else{
                // no marks yet familia
                $message = "Het klusje '".$reviewtask->title."' werd nog niet gemarkeerd als afgesloten, terwijl dat deze al een tijdje opgevuld werd door een klusser. Ben je dit misschien vergeten? Of werd het klusje nog niet uitgevoerd? Door op deze melding te klikken kan je naar de pagina van het klusje om het daar te markeren als afgehandeld.";
                $notificationMaker = Notifications::createNotification($maker, $fixer, $message, $url, $channelFixer, $type, $klussID);
                $notificationFixer = Notifications::createNotification($fixer, $maker, $message, $url, $channelMaker, $type, $klussID);
            }
            // return true;
        }
        // return true;
    }

    public function notificationsIndex(){
        $read = Notifications::readUserNotifications(\Auth::user()->id);
        $notifications = Notifications::getUserNotifications(\Auth::user()->id);
        return view('meldingen', compact('notifications', $notifications));
    }
}
