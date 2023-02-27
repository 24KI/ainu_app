<?php

namespace App\Http\Controllers\Ainu01;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

class Ainu01Study2Controller extends Controller
{
    //
    public function index()
    {
        $current_point = \Auth::user()->status->ainu01_study_count + 1;
        \Auth::user()->status()->update(["ainu01_study_count" => $current_point]);

        return view('ainu01/ainu01_study_2');
    }
}
