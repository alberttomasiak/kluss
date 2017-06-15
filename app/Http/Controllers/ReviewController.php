<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Kluss;
use App\User;
use App\Kluss_applicant;
use App\KlussCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\UserReview;

class ReviewController extends Controller
{
    public function __construct(){
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
    }

    public function index($task_id){
        $task = Kluss::get($task_id);
        $review = UserReview::reviewExists($task_id, \Auth::user()->id);
        if($task->user_id == \Auth::user()->id){
            $for = User::get($task->accepted_applicant_id);
        }else{
            $for = User::get($task->user_id);
        }
        return view('schrijfreview', compact('task', $task, 'review', $review, 'for', $for));
    }

    public function add(Request $request, $task_id){
        $task_id = $request->task_id;
        $maker_id = $request->maker_id;
        $fixer_id = $request->fixer_id;
        $score = $request->score;
        $review_msg = $request->review_msg;
        $writer = \Auth::user()->id;
        $review = UserReview::writeReview($maker_id, $fixer_id, $task_id, $review_msg, $score, $writer);
        return redirect()->back();
    }
}
