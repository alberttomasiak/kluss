<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserBlocks;
use App\User;

class UserBlockController extends Controller
{
    public function index(){
        $myblocks = UserBlocks::getUserBlocks(\Auth::user()->id);
        return view('profile.blocks', compact('myblocks', $myblocks));
    }
    public function blockUser(Request $request){
        $blockedID = $request->blocked_id;
        $blockerID = $request->blocker_id;
        $block_category = $request->block_category;
        $block_reason = $request->block_reason;

        $blockExists = UserBlocks::checkForBlocks($blockerID, $blockedID);

        if($blockExists == ""){
            $block = new UserBlocks;
            $block->blocker_id = $blockerID;
            $block->blocked_id = $blockedID;
            $block->block_category = $block_category;
            $block->block_reason = $block_reason;
            $block->save();
            $checkForBlocks = UserBlocks::blockCounter($blockedID);
            if($checkForBlocks >= 3){
                $banThatFool = User::BANHAMMER($blockedID);
                $archiveReports = UserBlocks::archiveUserReports($blockedID);
            }
            return redirect()->back()->with('succesful_report', 'De gebruiker werd successvol gerapporteerd.');
        }else{
            return redirect()->back()->with('already_blocked', 'De gebruiker werd door u al gerapporteerd.');
        }
    }
}
