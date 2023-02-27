<?php

namespace App\Http\Controllers\Scores;

use App\Http\Controllers\Controller;
use App\Models\Ainu01Score;
use Illuminate\Http\Request;
use function Termwind\render;

class Ainu01ScoreController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $scores = Ainu01Score::all();
        $data = ['scores' => $scores];
        return view('scores.ainu01.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ainu01Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(int $index)
    {
        //
        $score = $this->returnScore($index);
        $data = ['score' => $score];
        return view('scores.ainu01.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ainum01Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(int $index)
    {
        //
        $score = $this->returnScore($index);
        $data = ['score' => $score];
        return view('scores.ainu01.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ainu01Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $index)
    {
        //
        $score = $this->returnScore($index);

        $this->validate($request, [
            'type' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
            'question4' => 'required',
            'question5' => 'required',
            'question6' => 'required',
            'question7' => 'required',
            'question8' => 'required',
            'question9' => 'required',
            'question10' => 'required'
        ]);
        $score->type = $request->type;
        $score->question1 = $request->question1;
        $score->question2 = $request->question2;
        $score->question3 = $request->question3;
        $score->question4 = $request->question4;
        $score->question5 = $request->question5;
        $score->question6 = $request->question6;
        $score->question7 = $request->question7;
        $score->question8 = $request->question8;
        $score->question9 = $request->question9;
        $score->question10 = $request->question10;
        $score->quiz_success_count = $request->quiz_success_count;
        $score->quiz_point = $request->quiz_point;
        $score->save();

        return redirect(route('ainu01.show', $score->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ainu01Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $index)
    {
        //
        $score = $this->returnScore($index);
        $score->delete();
        return redirect(route('ainu01.index'));
    }

    public function returnScore(int $index) {

        $scores = Ainu01Score::all();
        $data = [];

        foreach ($scores as $score) {
            if ($score["id"] == $index) {
                $data = $score;
                break;
            }
        }
        return $data;
    }
}
