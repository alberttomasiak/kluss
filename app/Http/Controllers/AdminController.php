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
use Mail;
use App\Mail\TaskApproved;
use App\Mail\TaskDenied;
use App\Notifications;
use App;

class AdminController extends Controller
{
    var $pusher;

    public function __construct(){
        $this->pusher = App::make('pusher');
    }

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
        $archiveBlock = UserBlocks::archiveBlock(\Auth::user()->id, $userID);
        return redirect()->back();
    }

    // Klusjes
    public function taskOverview(){
        $tasks = Kluss::getOpenTasks();
        $approval = Kluss::getTasksForApproval();
        return view('admin.tasks.overview', ['tasks' => $tasks, 'approval' => $approval]);
    }
    public function taskClosed(){
        $tasks = Kluss::getClosedTasks();
        return view('admin.tasks.closed', ['tasks' => $tasks]);
    }
    public function approveTask($id){
        $task = Kluss::approveTask($id);
        $taskTitle = Kluss::getSingleTitle($id);
        $userData = Kluss::getUserMailForTaskID($id);
        $userMail = $userData->email;
        $userName = $userData->name;
        Mail::to($userMail)->send(new TaskApproved($taskTitle, $userName));
        return redirect()->back();
    }
    public function denyTask(Request $request){
        $id = $request->taskID;
        $taskTitle = Kluss::getSingleTitle($id);
        $userData = Kluss::getUserMailForTaskID($id);
        $task = Kluss::denyTask($id);
        $userMail = $userData->email;
        $userName = $userData->name;
        $reason = $request->denyReason;
        Mail::to($userMail)->send(new TaskDenied($taskTitle, $userName, $reason));
        return redirect()->back();
    }
    // settings
    public function settingsIndex(){
        $settings = GlobalSettings::getSettings();
        return view('admin.settings.index', ['settings' => $settings]);
    }
    public function settingsAdd(Request $request){
        $key = $request->settingKey;
        $value = $request->settingValue;

        $setting = new GlobalSettings;
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();
        return redirect()->back();
    }
    public function settingEdit(Request $request){
        $settingID = $request->settingID;
        $key = $request->settingKey;
        $value = $request->settingValue;

        $update = GlobalSettings::updateSetting($settingID, $key, $value);
        if($update == true){
            return redirect()->back();
        }
    }
    // Notifications
    public function notificationsIndex(){
        $notifications = Notifications::getAllAdminNotifications();
        return view('admin.notifications.index', ['notifications' => $notifications]);
    }
    public function sendGlobalnotification(Request $request){
        $user = $request->notification_user;
        $message = $request->notification_msg;
        $channel = $request->notification_channel;
        $url = $request->notification_url;
        $type = "global";

        $this->pusher->trigger($channel, "global-notification", $message);
        $notification = Notifications::createNotification($user, $user, $message, $url, $channel, $type, null);
        return redirect()->back();
    }
    public function sendPersonalNotification(Request $request, $id){
        $about_user = \Auth::user()->id;
        $for_user = $request->notification_user;
        $channel = User::getUserNotificationsChannel($for_user);
        $message = $request->notification_msg;
        $url = $request->notification_url;
        $type = "global";

        $this->pusher->trigger($channel, "new-notification", $message);
        $notification = Notifications::createNotification($about_user, $for_user, $message, $url, $channel, $type, null);
        return redirect()->back();
    }
}
