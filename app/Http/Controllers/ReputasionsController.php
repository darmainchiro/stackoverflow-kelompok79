<?php

namespace App\Http\Controllers;

use App\Reputasion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ReputasionsController extends Controller
{


    public function upVoteQuestion($id)
    {
        $userId = DB::table('questions')
                ->join('users','users.id','questions.user_id')
                ->select('questions.*','users.name as name','users.point as point')
                ->where('questions.id',$id)->first();

        $point = $userId->point;
        $userId = $userId->user_id;
        $user = DB::table('users')->where('id',$userId);
        if( $userId == Auth::id()){
            return redirect('questions/'.$id)->with('error','sebagai pembuat anda tidak dapat meng-UP pertanyaan anda sendiri');
        }
        $data = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->first();              
        if($data != null) {
            if( $data->vote == 1){
                return redirect('questions/'.$id)->with('error','Anda hanya dapat melakukan sekali seumur hidup :(');
            } else if( $data->vote == -1){
                $user->update(['point' => $point + 11]);        
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->where('answer_id', 0)
                        ->update(['vote' => 1]);
                return redirect('questions/'.$id);
            } 
        }
        DB::table('reputasions')->insert([
                'question_id' => $id,
                'user_id' => Auth::id(),
                'vote' => 1
            ]);
        $user->update(['point' => $point + 10]);
        return redirect('questions/'.$id);  
    }
    public function downVoteQuestion($id)
    {
        $userId = DB::table('questions')
                ->join('users','users.id','questions.user_id')
                ->select('questions.*','users.name as name','users.point as point')
                ->where('questions.id',$id)->first();

        $point = $userId->point;
        $userId = $userId->user_id;
        $user = DB::table('users')->where('id',$userId);
        if( $userId == Auth::id()){
           return redirect('questions/'.$id)->with('error','sebagai pembuat anda tidak dapat meng-DOWN pertanyaan anda sendiri');
        }
        $data = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id',  $id)
                        ->first();

        if($data != null) {
            if( $data->vote == 1){
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->where('answer_id', 0)
                        ->update(['vote' => -1]);
                $user->update(['point' => $point - 11]);

                return redirect('questions/'.$id);
            } else if( $data->vote == -1){

                 return redirect('questions/'.$id)->with('error','Anda hanya dapat melakukan sekali seumur hidup :(');
            } 
        }
        DB::table('reputasions')->insert([
                'question_id' => $id,
                'user_id' => Auth::id(),
                'vote' => -1.
            ]);
        $user->update(['point' => $point - 1]);
        return redirect('questions/'.$id);
    }

    public function upVoteAnswer($id, $question_id)
    {
        $user = DB::table('answers')
                        ->where('answers.id',$id)
                        ->join('users','users.id','answers.user_id')
                        ->select('answers.*','users.point as point');

                        
        $data = $user->first();
        $point = $data->point;
                        

        $userId = $data->user_id;
        if( $userId == Auth::id()){
            return redirect('questions/' . $data->question_id)->with('error','sebagai pembuat anda tidak dapat meng-UP jawaban anda sendiri');
        }
        $dataReputasi = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('answer_id','=',$id)
                        ->first();

            
        
        if($dataReputasi != null) {
            if( $dataReputasi->vote == 1){
                return redirect('questions/' . $dataReputasi->question_id)->with('error','Anda hanya dapat melakukan sekali seumur hidup :(');
            } else if( $dataReputasi->vote == -1){
                $user->update(['point' => $point + 11]);
                DB::table('reputasions')
                        ->where('user_id',Auth::id())
                        ->where('question_id',$question_id)
                        ->where('answer_id', $id)
                        ->update(['vote' => 1]);

                return redirect('questions/' . $data->question_id);
            } 
        }
        DB::table('reputasions')->insert([
                'answer_id' => $id,
                'question_id' =>  $data->question_id,
                'user_id' => Auth::id(),
                'vote' => 1
            ]);
        $user->update(['point' => $point + 10]);
        return redirect('questions/' . $data->question_id);
    }


     public function downVoteAnswer($id, $question_id)
    {
        $user = DB::table('answers')
                        ->where('answers.id',$id)
                        ->join('users','users.id','answers.user_id')
                        ->select('answers.*','users.point as point');

                        
        $data = $user->first();
        $point = $data->point;

        $userId = $data->user_id;
        if( $userId == Auth::id()){
            return redirect('questions/' . $data->question_id)->with('error','sebagai pembuat anda tidak dapat meng-DOWN jawaban anda sendiri');
        }
        $dataReputasi = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('answer_id','=',$id)
                        ->first();

            
    
        if($dataReputasi != null) {
            if( $dataReputasi->vote == -1){
                return redirect('questions/' . $dataReputasi->question_id)->with('error','Anda hanya dapat melakukan sekali seumur hidup :(');
            } else if( $dataReputasi->vote == 1){
                $user->update(['point' => $point - 11]);
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=', $question_id)
                        ->where('answer_id', $id)
                        ->update(['vote' => -1]);
                return redirect('questions/' . $data->question_id);
            } 
        }
        DB::table('reputasions')->insert([
                'answer_id' => $id,
                'question_id' =>  $data->question_id,
                'user_id' => Auth::id(),
                'vote' => -1
            ]);
        $user->update(['point' => $point - 1]);
        return redirect('questions/' . $data->question_id);
    }

    public static function get()
    {
        $data = DB::table('reputasions')->get();
        return $data;
    }

  
}
