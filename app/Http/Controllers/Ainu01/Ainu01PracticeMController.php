<?php

namespace App\Http\Controllers\Ainu01;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ainu01PracticeMController extends Controller
{
    //
    public function index(){
        return view('ainu01/ainu01_practice_menu');
    }
}
