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

class ProfielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        //$profiel = DB::table('users')->where('id', '=', $id)->get();
        $profiel = \App\User::findOrFail($id); //Input::get('id')
        $openklusjes = DB::table('kluss')->where([
                ['user_id', '=', $id],
                ['accepted', '=', 0],
            ])->get();
        $data['profiel'] = $profiel;
        $data['openkluss'] = $openklusjes;
        return view('kluss/profiel', $data)->with('title', 'Profiel');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
