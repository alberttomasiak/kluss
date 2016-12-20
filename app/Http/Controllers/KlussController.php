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

    public function SingleKluss($id){
        $kluss = DB::table('kluss')->where('id', '=', $id)->get();
        $title = DB::table('kluss')->where('id', '=', $id)->value('title');
        $kluss_applicant = DB::table('kluss_applicants')->where([
            ['kluss_id', '=', $id],
            ['user_id', '=', \Auth::user()->id],
            ])->get();
        return view('kluss/individual', compact('kluss', 'kluss_applicant'))->with('title', $title);
    }

    public function apply($id){
        $kluss = DB::table('kluss')->where('id', '=', $id)->get();
        $title = DB::table('kluss')->where('id', '=', $id)->value('title');
        $kluss_applicant = DB::table('kluss_applicants')->where([
            ['kluss_id', '=', $id],
            ['user_id', '=', \Auth::user()->id],
            ])->get();

        if($kluss_applicant->first()){
            DB::table('kluss_applicants')->where([
                ['kluss_id', '=', $id],
                ['user_id', '=', \Auth::user()->id],
                ])->delete();
        }else{
            DB::table('kluss_applicants')->insert(
                ['kluss_id' => $id, 'user_id' => \Auth::user()->id]
            );
        }
        return redirect()->back()->with('title', $title, compact('kluss','kluss_applicant'));
        //return redirect('/kluss/'.$kluss->id);
        //return redirect()->back(compact('kluss','kluss_applicant'))->with('title', $title);
    }
}
