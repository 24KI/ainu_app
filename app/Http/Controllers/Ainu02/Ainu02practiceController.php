<?php

namespace App\Http\Controllers\Ainu02;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ainu02practiceController extends Controller
{
    //
    public function index()
    {
        $current_point = \Auth::user()->status->ainu02_practice_count + 1;
        \Auth::user()->status()->update(["ainu02_practice_count" => $current_point]);

        return view('ainu02/ainu02_practice');
    }

    public function create(Request $request)
    {
        \Auth::user()->ainu02_scores()->create([
            "user_id" => \Auth::id(),
            "type" => "Prac",
        ]);
    }

    public function update(Request $request)
    {
        //
        foreach ($request->input() as $key => $val) {

            \Auth::user()->ainu02_scores()->where("type", "Prac")->latest()->first()->update([$key => $val]);

            if ($key == "quiz_point") {
                $this->updateStatus($request->input()["quiz_point"]);
            }
        }
    }

}
