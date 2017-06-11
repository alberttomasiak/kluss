<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use App\Kluss;
use DB;
use App\Conversation;
use App\Message;

class KlussGoldController extends Controller
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
        return view('klussgold');
    }

    public function bestel(Request $request){
        $months = $request->get('months');

        return view('bestelgold', compact('months', $months));
    }

    /*public function getTasks(Request $request){
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        $klusjes = Kluss::getTasksInNeighborhood($lat, $lng);
        return [$klusjes];
    }*/
}