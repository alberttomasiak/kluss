<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Kluss;
use App\Message;
use App\Conversation;
use App\UserBlocks;
use App\GlobalSettings;

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
        $adminUsers = User::getAdminUsers();
        $regularUsers = User::getRegularUsers();
        $goldUsers = User::getGoldUsers();
        return view('admin.users.overview', ['adminUsers' => $adminUsers, 'regularUsers' => $regularUsers, 'goldUsers' => $goldUsers]);
    }

    public function userReports(){
        $userReports = UserBlocks::getUserReportsByDate();
        $archivedReports = UserBlocks::getArchivedReports();
        return view('admin.users.reports', ['userReports' => $userReports, 'archivedReports' => $archivedReports]);
    }
    public function userBlocks(){
        $userBlocks = User::getBlockedUsers();
        return view('admin.users.blocks', ['userBlocks' => $userBlocks]);
    }
    public function blockUser($userID){
        $block = User::BANHAMMER($userID);
        return redirect()->back();
    }
    public function unblockUser($userID){
        $unblock = User::unblockUser($userID);
        return redirect()->back();
    }

    // Klusjes
    public function taskOverview(){
        $tasks = Kluss::getOpenTasks();
        return view('admin.tasks.overview', ['tasks' => $tasks]);
    }
    public function taskClosed(){
        $tasks = Kluss::getClosedTasks();
        return view('admin.tasks.closed', ['tasks' => $tasks]);
    }
    // settings
    public function settingsIndex(){
        $settings = GlobalSettings::getSettings();
        return view('admin.settings.index', ['settings' => $settings]);
    }
    public function settingsAdd(Request $request){
        dd($request);
    }
}
