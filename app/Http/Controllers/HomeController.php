<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use App\Kluss;
use DB;

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
        return view('home', compact('klussjes'));
    }

    public function getTasks(Request $request){
        return true;
    }
}
