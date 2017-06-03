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

    public function register(Request $request){
        dd($request);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_code' => str_random(45);
        ]);

        $verification = User::sendVerificationMail($data['email']);
        return $verification ? redirect()->back()->with('verificationMail', "Uw verificatie mail werd verstuurd. Om uw account te activeren klik op de link in de mail.") : "Er is iets misgelopen.";
    }
}
