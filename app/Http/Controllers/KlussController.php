<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Kluss;

class KlussController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('kluss/add');
    }
}
