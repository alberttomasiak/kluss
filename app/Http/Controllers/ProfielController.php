<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Kluss;
use App\User;
use App\BlockReasons;
use App\UserReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ProfielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userInfo = User::getTargetInfo($id);
        // reviews
        $reviews = UserReview::getUserReviews($id);
        $reviewCount = UserReview::getUserReviewCount($id);
        $reviewScore = UserReview::getUserReviewScore($id);
        // activities
        $activities = Kluss::getUserActivities($id);
        $activityCounter = Kluss::countUserActivities($id);
        // tasks
        $tasks = Kluss::getAllOpenActivities($id, 2);
        $openTaskCounter = Kluss::countUserTasks($id);
        // ...
        return view('profile.index', compact('userInfo', 'reviewCount', 'reviewScore', 'reviews', 'activities', 'activityCounter', 'tasks', 'openTaskCounter'));
    }

    public function testIndex($id){

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
