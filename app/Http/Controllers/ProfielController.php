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
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,id,'.$request->userID,
            'bio' => 'required',
            'password' => 'min:6|confirmed',
            'profile_pic' => 'image',
        ]);

        $userID = $request->userID;
        $name = $request->name;
        $email = $request->email;
        $bio = $request->bio;
        $pass1 = $request->password == "" ? null : $request->password;
        $pass2 = $request->password_confirm == "" ? null : $request->password_confirm;
        $image = $request->profile_pic;

        if(Input::hasFile('profile_pic')){
            $file = Input::file('profile_pic');
            $extension = Input::file('profile_pic')->getClientOriginalExtension();
            $fileName = "profiel-".\Auth::user()->id . time() . "." . $extension;
            $destinationPath = "/img/profile/".$fileName;
            $file->move('assets/img/profile', $fileName);
            // we've stored the profile pic on our server, so now let's store the path in our database, along other information.
            if($pass1 != null){
                $hashP1 = bcrypt($pass1);
                $profile = User::updateProfile($userID, $name, $email, $bio, $hashP1, $destinationPath);
            }else{
                $profile = User::updateProfile($userID, $name, $email, $bio, null, $destinationPath);
            }
            return redirect()->back()->with('success', 'Uw profiel werd successvol aangepast.');
        }else{
            if($pass1 != null){
                $hashP1 = bcrypt($pass1);
                $profile = User::updateProfile($userID, $name, $email, $bio, $hashP1, null);
            }else{
                $profile = User::updateProfile($userID, $name, $email, $bio, null, null);
            }
            return redirect()->back()->with('success', 'Uw profiel werd successvol aangepast.');
        }
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
