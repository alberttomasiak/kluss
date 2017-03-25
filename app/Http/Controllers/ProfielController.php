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
        $personalData = \App\User::getTargetInfo($id);
        $klussjes = \App\Kluss::getUserKluss($id);
        $sollicitanten = \App\Kluss_applicant::getApplicants($id);

        // historiek van uitgevoerde klussjes
        // reviews gebruikers
        return view('/profile/profiel', compact('personalData', 'klussjes', 'sollicitanten'))->with('title', 'Profiel');
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
