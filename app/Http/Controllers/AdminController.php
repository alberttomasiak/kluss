<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Kluss;

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
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = User::where('email', $request->email)->first();
            if(User::is_admin($user->account_type)){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/home');
            }
        }
        return redirect()->back();
    }

    public function getData(){
        // Users
        $registeredUsers = User::getRegisteredUserCount();
        $activeTasks = Kluss::getActiveTaskCount();
        $goldUsers = User::getGoldUserCount();
        // Tasks

        // Messages
        return [$registeredUsers, $activeTasks, $goldUsers];
    }
}
