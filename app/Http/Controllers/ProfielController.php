<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Kluss;
use App\User;
use App\BlockReasons;
use App\UserBlocks;
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
        $block_categories = BlockReasons::getCategories();
        return view('profile.index', compact('userInfo', 'reviewCount', 'reviewScore', 'reviews', 'activities', 'activityCounter', 'tasks', 'openTaskCounter', 'block_categories'));
    }

    public function settingsIndex(){
        $userData = User::getCurrentUser();
        $myBlocks = UserBlocks::getUserBlocks(\Auth::user()->id);
        return view('settings.index', compact('userData', 'myBlocks'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        dd($request);
    }

    public function unblockUser($id){
        $unblock = User::unblockUser($userID);
        $archiveBlock = UserBlocks::archiveBlock(\Auth::user()->id, $userID);
        return redirect()->back()->with('unblocked', 'Deze gebruiker werd gedeblokkeerd.');
    }

    public function destroy($id)
    {
        //
    }
}
