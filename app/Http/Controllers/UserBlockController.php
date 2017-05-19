<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserBlocks;

class UserBlockController extends Controller
{
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
            $block_category = $block_category;
            $block_reason = $block_reason;
            $block->save();
            return redirect()->back()->with('succesful_report', 'De gebruiker werd successvol gerapporteerd.');
        }else{
            return redirect()->back()->with('already_blocked', 'De gebruiker werd door u al gerapporteerd.');
        }
    }
}
