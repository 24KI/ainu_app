<?php

namespace App\Http\Controllers\Ainu02;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ainu02studyController extends Controller
{
    //
    public function index()
    {
        $current_point = \Auth::user()->status->ainu02_study_count + 1;
        \Auth::user()->status()->update(["ainu02_study_count" => $current_point]);

        return view('ainu02/ainu02_study');
    }
}
