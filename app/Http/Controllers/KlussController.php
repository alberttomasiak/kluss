<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Kluss;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

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
            $kluss_image = $request->file;
            $price = $request->price;
            $date = Carbon::now()->toDateTimeString();
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $user_id = \Auth::user()->id;
            $address = $request->address;

            if(Input::hasFile('file')){
            $file = Input::file('file');
            if(substr($file->getMimeType(), 0, 5) == 'image'){
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileName = "kluss-". \Auth::user()->id . time() . "." . $extension;

                $destinationPath = "img/klussjes/". $fileName;
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
}
