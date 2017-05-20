<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Kluss;
use App\Message;
use App\Conversation;
use App\UserBlocks;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function dashboard(){
        return view('admin.dashboard.index');
    }

    public function login(Request $request){
        // custom authentication method
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if(User::is_admin($user->account_type)){
            if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])){
                return redirect('/admin/dashboard');
            }
        }else{
            return redirect()->back()->with('not_admin', 'Deze gegevens komen niet overeen met onze data.');
        }

        return redirect()->back();
    }

    public function getData(){
        // Users
        $registeredUsers = User::getRegisteredUserCount();
        $verifiedUsers = User::getVerifiedUserCount();
        $goldUsers = User::getGoldUserCount();
        $blockedUsers = User::getBlockedUserCount();
        $reportedCounter = UserBlocks::userReportCount();
        // Tasks
        $activeTasks = Kluss::getActiveTaskCount();
        $closedTasks = Kluss::getClosedTaskCount();
        // Conversations
        $conversationsCounter = Conversation::getConversationsCounter();
        $sentMessages = Message::getSentMessagesCount();
        return [$registeredUsers, $verifiedUsers, $goldUsers, $blockedUsers, $reportedCounter, $activeTasks, $closedTasks, $conversationsCounter, $sentMessages];
    }

    // Users
    public function userOverview(){
        $X = 0;
        return view('admin.users.overview', ['X' => $X]);
    }

    public function userReports(){
        $X = 0;
        return view('admin.users.reports', ['X' => $X]);
    }

    public function userBlocks(){
        $X = 0;
        return view('admin.users.blocks', ['X' => $X]);
    }
    // Klusjes
    public function taskOverview(){
        $X = 0;
        return view('admin.tasks.overview', ['X' => $X]);
    }
    public function taskClosed(){
        $X = 0;
        return view('admin.tasks.closed', ['X' => $X]);
    }
    // settings
    public function settingsIndex(){
        return view('admin.settings.index');
    }
}
