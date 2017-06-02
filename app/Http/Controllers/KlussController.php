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
use App\Kluss_applicant;
use App\KlussCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class KlussController extends Controller
{
    var $pusher;
    var $user;

    public function __construct(){
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
    }

    public function index(){
        $kluss_categories = KlussCategories::getCategories();
        return view('kluss/add', compact('kluss_categories'))->with('title', 'Voeg een Kluss toe');
    }

    public function add(Request $request){
        dd($request);
        $title = $request->title;
        $description = $request->description;
        $kluss_image = $request->kluss_image;
        $price = $request->price;
        $date = Carbon::now()->toDateTimeString();
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $user_id = \Auth::user()->id;
        $address = $request->address;
        $time = $request->kluss_time;
        $category = $request->kluss_category;

        if(Input::hasFile('kluss_image')){
            $file = Input::file('kluss_image');
            if(substr($file->getMimeType(), 0, 5) == 'image'){
                $extension = Input::file('kluss_image')->getClientOriginalExtension();
                $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;
                $destinationPath = "/img/klussjes/". $fileName;
                $file->move('assets/img/klussjes', $fileName);
                if($description == ""){
                    $description = "Geen beschrijving beschikbaar.";
                }
                $query = DB::table('kluss')->insert(
                    ['title' => $title, 'description' => $description, 'kluss_image' => $destinationPath, 'price' => $price, 'address' => $address, 'date' => $date, 'latitude' => $latitude, 'longitude' => $longitude, 'user_id' => $user_id]
                );
                $id = Kluss::getLatestID($user_id);
                $kluss = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'kluss_image' => $destinationPath,
                    'price' => $price,
                    'address' => $address,
                    'date' => $date,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'user_id' => $user_id
                ];
                $this->pusher->trigger("kluss-map", "new-task", $kluss);
                if($query){
                    return redirect('/home');
                }
            }
        }else{
            if($description == ""){
                $description = "Geen beschrijving beschikbaar.";
            }
            $query = DB::table('kluss')->insert(
                ['title' => $title, 'description' => $description, 'kluss_image' => "/img/klussjes/geen-image.png", 'price' => $price, 'address' => $address, 'date' => $date, 'latitude' => $latitude, 'longitude' => $longitude, 'user_id' => $user_id]
            );
            $id = Kluss::getLatestID($user_id);
            $kluss = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'kluss_image' => "/img/klussjes/geen-image.png",
                'price' => $price,
                'address' => $address,
                'date' => $date,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'user_id' => $user_id
            ];
            $this->pusher->trigger("kluss-map", "new-task", $kluss);
            if($query){
                return redirect('/home');
            }
        }
    }

    public function SingleKluss($id){
        $kluss = Kluss::getSingle($id);
        $title = Kluss::getSingleTitle($id);
        $kluss_applicant = Kluss_applicant::getApplicant($id);
        $kluss_applicants = Kluss_applicant::getAllApplicants($id);
        $accepted_applicant = Kluss_applicant::getAcceptedApplicant($id);
        return view('kluss/individual', compact('kluss', 'kluss_applicant', 'kluss_applicants', 'accepted_applicant'))->with('title', $title);
    }

    public function acceptUser(Request $request){
        // 1. Gather user information
        $taskID = $request->kluss_id;
        $acceptedID = $request->user_id;
        // 2. Set his status to accepted in kluss_applicants
        $acceptUser = Kluss_applicant::acceptApplicant($taskID, $acceptedID);
        // 3. Delete all other applicants
        $deleteApplicants = Kluss_applicant::deleteNotAcceptedApplicants($taskID);
        // 4. Set the task to accepted in the kluss table
        $applicantTableID = Kluss_applicant::getApplicantTableID($taskID, $acceptedID);
        $taskStatus = Kluss::acceptUser($taskID, $applicantTableID);
        // 5. Remove the apply btn on the task
        $accepted_applicant = Kluss_applicant::getAcceptedApplicant($taskID);
        $userImage = $accepted_applicant->profile_pic;
        $userID = $accepted_applicant->id;
        $userName = $accepted_applicant->name;
        // 6. Send the update to our map --> pusher.js implementation
        $selected = [
            'taskID' => $taskID,
            'userName' => $userName,
            'userID' => $userID,
            'userImage' => $userImage
        ];
        $this->pusher->trigger("kluss-map", "applicant-selected-task", $selected);
        // 7. Return after everything is handled
        return redirect()->back();
    }

    public function refuseUser(Request $request){
        $taskID = $request->kluss_id;
        $refusedID = $request->user_id;
        $removeApplier = Kluss_applicant::removeApplicant($taskID, $refusedID);

        if($removeApplier == true){
            return redirect()->back();
        }
    }

    public function apply($id){
        $kluss = Kluss::getSingle($id);
        $title = Kluss::getSingleTitle($id);
        $kluss_applicant = Kluss_applicant::getApplicant($id);

        if($kluss_applicant->first()){
            Kluss_applicant::removeApplication($id);
        }else{
            Kluss_applicant::insertApplicant($id);
        }
        return redirect()->back()->with('title', $title, compact('kluss','kluss_applicant'));
        //return redirect('/kluss/'.$kluss->id);
        //return redirect()->back(compact('kluss','kluss_applicant'))->with('title', $title);
    }

    public function update($id){
        $kluss = Kluss::getSingle($id);
        return view('kluss/bewerken', compact('kluss'))->with('title', 'Kluss bewerken');
    }

    public function edit(Request $request, $id){
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $user_id = \Auth::user()->id;
        $address = $request->address;

        if($description == ""){
            $description = "Geen beschrijving beschikbaar.";
        }

        $query = DB::table('kluss')->where('id', '=', $id)->update(
            ['title' => $title,
            'description' => $description,
            'price' => $price,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address]
        );

        if(Input::hasFile('kluss_image')){
        $file = Input::file('kluss_image');
        if(substr($file->getMimeType(), 0, 5) == 'image'){
            $extension = Input::file('kluss_image')->getClientOriginalExtension();
            $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;

            $destinationPath = "/img/klussjes/". $fileName;
            $file->move('img/klussjes', $fileName);

            $queryImage = DB::table('kluss')->where('id', '=', $id)->update([
                'kluss_image' => $destinationPath
            ]);

            }
        }
        return redirect()->back();
    }

    public function calculateUserDistance(Request $request){
        $userlat = $request->get('userlat');
        $userlng = $request->get('userlng');
        $tasklat = $request->get('tasklat');
        $tasklng = $request->get('tasklng');
        $userID = $request->get('userID');
        $account_type = User::checkAccountType($userID);

        $theta = $userlng - $tasklng;
        $dist = sin(deg2rad($userlat)) * sin(deg2rad($tasklat)) +  cos(deg2rad($userlat)) * cos(deg2rad($tasklat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = $miles * 1.609344; // to km conversion
        return response()->json([
            'distance' => $distance,
            'account_type' => $account_type
        ]);
    }

    public function delete($id){
        $delete = Kluss::deleteTask($id);
        $deleted = [
            'taskID' => $id
        ];
        $this->pusher->trigger("kluss-map", "deleted-task", $deleted);
        return redirect('/home');
    }
}
