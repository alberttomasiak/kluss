<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use App\Kluss;
use DB;
use App\Conversation;
use App\Message;
use App\GoldStatus;
use Carbon\Carbon;
use App;
use Mail;
use App\Mail\KlussGoldPurchase;
use App\User;
use App\Notifications;

class KlussGoldController extends Controller
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
        $gold = GoldStatus::checkGoldStatus(\Auth::user()->id);
        return view('klussgold', compact('gold', $gold));
    }

    public function bestel(Request $request){
        $months = $request->get('months');
        return view('bestelgold', compact('months', $months));
    }

    public function purchaseGold($user_id, $duration){
        $user = $user_id;
        $dur = $duration;
        // First step, generate the gold status in our gold_status table
        $start_date = Carbon::now()->toDateTimeString();
        if($duration > 1){
            $end_date = Carbon::now()->addMonths($dur);
        }else{
            $end_date = Carbon::now()->addMonth($dur);
        }
        $goldUser = GoldStatus::createGoldUser($user, $start_date, $end_date);
        // Second step, alter our user table --> set account_type to gold and insert our Foreign key
        $gold_status_fk = GoldStatus::getIDByUser($user);
        $userTable = User::AddGoldToUser($user, $gold_status_fk);
        // Third step, send a notification to the user that his purchase has been confirmed and when his subscription expires
        $notificationChannel = User::getUserNotificationsChannel($user);
        $message = "Uw betaling voor KLUSS Gold werd geaccepteerd!";
        $this->pusher->trigger($notificationChannel, "new-notification", $message);
        $fullMessage = "Uw betaling voor KLUSS Gold werd geaccepterd. Uw subscriptie verloopt op: ".substr($end_date, 0, 10);".";
        $notification = Notifications::createNotification($user, $user, $fullMessage, null, $notificationChannel, "global", null);
        // Fourth step, send an email to the user with the same information as the notification
        $userMail = User::getUserMail($user);
        $userName = User::get($user);
        $mailDate = substr($end_date, 0, 10);
        Mail::to($userMail)->send(new KlussGoldPurchase($userName, $mailDate));
        return redirect()->back();

    }

    /*public function getTasks(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $klusjes = Kluss::getTasksInNeighborhood($lat, $lng);
        return [$klusjes];
    }*/
}
