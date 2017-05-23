<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $AmIBanned = User::amIBanned($request->email);

        if($AmIBanned == 0){
            if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])){
                return redirect('/home');
            }
        }

        return redirect()->back()->with('ImBannedBro', "Dit account is geblokkeerd.");
    }
}
