<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        dd($answers);       
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
    public function store(Request $request, $id)
    {
         Answer::create([
            'user_id' => Auth::id(),
            'question_id' => $id,
            'content' => $request->content,
            'vote' => 0,
            'best_answer' => false,
            'waktu_buat' => time()
        ]);
         return redirect('questions/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
    public function comment(Request $request)
    {
        $data = $request->all();

        DB::table('answer_comment')->insert([
                'question_id' => $request->question_id,
                'answer_id' => $request->answer_id,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
                'waktu_buat' => time()
        ]);
        return redirect('questions' . '/' . $request->question_id);
    }
    public function bestAnswer($id,$questionId)
    {
        DB::table('answers')->where('id',$id)->update(['best_answer' => 1]);
        return redirect('/questions/' . $questionId);
    }
}
