<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Kluss;
use App\User;
use App\Contact;
use App\Kluss_applicant;
use App\KlussCategories;
use App\Notifications;
use App\KlussFinished;
use App\KlussPay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;


class contactController extends Controller
{
    //Input::get('name');
    public function sendContact(Request $request){
        $name_company = Input::get('auteur');
        $category = Input::get('contact_categorie');
        $email = Input::get('email');
        $subject = Input::get('subject');
        $commentaar = Input::get('commentaar');
        $sendContact = Contact::sendContact($name_company, $category, $email, $subject, $commentaar);
        return redirect()->back();
    }
}
