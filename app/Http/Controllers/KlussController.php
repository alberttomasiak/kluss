<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Kluss;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class KlussController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('kluss/add')->with('title', 'Voeg een Kluss toe');
    }

    public function add(Request $request){
            $title = $request->title;
            $description = $request->description;
            $kluss_image = $request->kluss_image;
            $price = $request->price;
            $date = Carbon::now()->toDateTimeString();
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $user_id = \Auth::user()->id;
            $address = $request->address;

            if(Input::hasFile('kluss_image')){
            $file = Input::file('kluss_image');
            if(substr($file->getMimeType(), 0, 5) == 'image'){
                $extension = Input::file('kluss_image')->getClientOriginalExtension();
                $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;

                $destinationPath = "/img/klussjes/". $fileName;
                $file->move('img/klussjes', $fileName);

                if($description == ""){
                    $description = "Geen beschrijving beschikbaar.";
                }

                $query = DB::table('kluss')->insert(
                    ['title' => $title, 'description' => $description, 'kluss_image' => $destinationPath, 'price' => $price, 'address' => $address, 'date' => $date, 'latitude' => $latitude, 'longitude' => $longitude, 'user_id' => $user_id]
                );

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

            if($query){
                return redirect('/home');
            }
        }
    }

    public function SingleKluss($id){
        $kluss = \App\Kluss::getSingle($id);
        $title = \App\Kluss::getSingleTitle($id);
        $kluss_applicant = \App\Kluss_applicant::getApplicant($id);
        return view('kluss/individual', compact('kluss', 'kluss_applicant'))->with('title', $title);
    }

    public function apply($id){
        $kluss = \App\Kluss::getSingle($id);
        $title = \App\Kluss::getSingleTitle($id);
        $kluss_applicant = \App\Kluss_applicant::getApplicant($id);

        if($kluss_applicant->first()){
            \App\Kluss_applicant::deleteApplicant($id);
        }else{
            \App\Kluss_applicant::insertApplicant($id);
        }
        return redirect()->back()->with('title', $title, compact('kluss','kluss_applicant'));
        //return redirect('/kluss/'.$kluss->id);
        //return redirect()->back(compact('kluss','kluss_applicant'))->with('title', $title);
    }

    public function update($id){
        $kluss = \App\Kluss::getSingle($id);
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

        $theta = $userlng - $tasklng;
        $dist = sin(deg2rad($userlat)) * sin(deg2rad($tasklat)) +  cos(deg2rad($userlat)) * cos(deg2rad($tasklat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = $miles * 1.609344; // to km conversion
        return $distance;
    }
}
