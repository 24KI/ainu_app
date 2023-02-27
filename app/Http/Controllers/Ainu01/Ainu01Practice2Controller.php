<?php

namespace App\Http\Controllers\Ainu01;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ainu01Practice2Controller extends Controller
{
    //
    public function index()
    {
        $current_point = \Auth::user()->status->ainu01_practice_count + 1;
        \Auth::user()->status()->update(["ainu01_practice_count" => $current_point]);

        return view('ainu01/ainu01_practice_2');
    }

    public function create(Request $request)
    {
        \Auth::user()->ainu01_scores()->create([
            "user_id" => \Auth::id(),
            "type" => "P2",
        ]);
    }

    public function update(Request $request)
    {
        //
        foreach ($request->input() as $key => $val) {

            \Auth::user()->ainu01_scores()->where("type", "P2")->latest()->first()->update([$key => $val]);

            if ($key == "quiz_point") {
                $this->updateStatus($request->input()["quiz_point"]);
            }
        }
    }

    public function updateStatus(int $quiz_point) {

        $current_point = \Auth::user()->status->ainu01_total_quiz_point + $quiz_point;
        \Auth::user()->status()->update(["ainu01_total_quiz_point" => $current_point]);

        if ($current_point >= 0 && $current_point < 100) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "beginner.png"]);
        }
        elseif ($current_point >= 100 && $current_point < 200) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "elementaly.png"]);
        }
        elseif ($current_point >= 200 && $current_point < 400) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "intermediate.png"]);
        }
        elseif ($current_point >= 400 && $current_point < 600) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "advanced.png"]);
        }
        elseif ($current_point >= 600 && $current_point < 800) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "master.png"]);
        }
        elseif ($current_point >= 800 && $current_point < 1000) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "proficiency.png"]);
        }
        elseif ($current_point >= 1000) {
            \Auth::user()->status()->update(["ainu01_cognomen" => "native.png"]);
        }
    }
}
