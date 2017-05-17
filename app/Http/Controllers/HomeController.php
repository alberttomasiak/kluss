<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use App\Kluss;
use DB;
use App\Conversation;
use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klussjes = \App\Kluss::getPublished();
        Conversation::createConversation(\Auth::user()->email);
        Message::sendDefaultMessage(\Auth::user()->email);
        return view('home', compact('klussjes', $klussjes));
    }

    public function getTasks(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $klusjes = \App\Kluss::getTasksInNeighborhood($lat, $lng);
        return [$klusjes];
    }
}
