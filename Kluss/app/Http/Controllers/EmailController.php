<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
use App\Http\Requests;
use App\User;
use App\NewsletterMembers;
use App\Notifications\NewsletterFirst;
use Notification;
use Illuminate\Notifications\Notifiable;

class EmailController extends Controller
{
    public function send(Request $request){
        //$users = \App\User::all();
        //$mailingusers = DB::table('newsletter_members')->pluck('email');
        $mailingusers = \App\NewsletterMembers::all();

       foreach($mailingusers as $email){
           //$user = \App\User::where('email', $email)->first();
           $email->notify(new NewsletterFirst());
           //$user->notify(new NewsletterFirst());
       }
       return redirect('/home');
    }
}
