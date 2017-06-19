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
        $pass = $request->password;
        $user = User::where('email', $request->email)->get();
        $AmIBanned = User::amIBanned($request->email);
        $amIActivated = User::amIActivated($request->email);
        if(count($user) != 0){
            if($amIActivated == 1){
                if($AmIBanned == 0){
                    if(Auth::attempt([
                        'email' => $request->email,
                        'password' => $request->password
                    ])){
                        return redirect('/home');
                    }else{
                        return redirect()->back()->with('ImBannedBro', "Uw wachtwoord klopt niet.");
                    }
                }else{
                    return redirect()->back()->with('ImBannedBro', "Dit account is geblokkeerd.");
                }
            }else{
                return redirect()->back()->with('activated', "Dit account is nog niet geactiveerd.");
            }
        }else{
            return redirect()->back()->with('ImBannedBro', "Deze gegevens komen niet overeen met onze data.");
        }

    }

    public function verifyAccount($code){
        $verify = User::verifyAccount($code);
        return $verify ? redirect('/aanmelden')->with('verified', 'Uw account werd succesvol geverifiëerd. U kunt nu aanmelden.') : redirect('/');
    }

    public function verificationIndex(){
        return view('/user/verification');
    }

    public function resendVerification(Request $request){
        $email = $request->verification_box;
        $mail = User::resendVerificationMail($email);
        return redirect()->back()->with('successful', 'Verwacht uw verificatie e-mail binnen een aantal minuten.');
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $generateCode = User::generateVerificationCode($request['email']);
        $generateChannel = User::generateNotificationsChannel($request['email']);
        $verification = User::sendVerificationMail($request['email']);
        return $verification ? redirect()->back()->with('verificationMail', "Uw verificatie mail werd verstuurd. Om uw account te activeren klik op de link in de mail.") : "Er is iets misgelopen.";
    }
}
