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

class ReviewController extends Controller
{
    public function __construct(){
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
    }

    public function index(){
        return view('schrijfreview');
    }

    public function add(Request $request){

    }

    public function update($id){
        /*$kluss = Kluss::getSingle($id);
        return view('kluss/bewerken', compact('kluss'))->with('title', 'Kluss bewerken');*/
    }

    public function edit(Request $request, $id){
        /*$title = $request->title;
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
        return redirect()->back();*/
    }

    public function delete($id){
        /*$delete = Kluss::deleteTask($id);
        $deleted = [
            'taskID' => $id
        ];
        $this->pusher->trigger("kluss-map", "deleted-task", $deleted);
        return redirect('/home');*/
    }
}
