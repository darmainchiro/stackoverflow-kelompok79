<?php

namespace App\Http\Controllers;

use App\Answer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $answer = Answer::get($id);
        $user = User::get($answer->user_id);
        $point = $user->point;

        if($answer->best_answer == 1){

            Answer::updateOne(['best_answer' => 0],$id);
            User::updateOne(['point' => $point - 15],$answer->user_id);
            return redirect('/questions/' . $questionId);
        } else if($answer->best_answer == 0){
            Answer::updateOne(['best_answer' => 1],$id);
            User::updateOne(['point' => $point + 15],$answer->user_id);
            return redirect('/questions/' . $questionId);
        } else {
            return redirect('/questions/' . $questionId);
        }
    
        
        return redirect('/questions/' . $questionId);
    }
}
