<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        if (\Auth::user()->status()->count() == 0) {
            \Auth::user()->status()->create([]);
        }
        return view('home');
    }

    /**
     * control admin page
     *
     * @return void
     */
    public function adminHome()
    {
        return view('admin-home');
    }
}
