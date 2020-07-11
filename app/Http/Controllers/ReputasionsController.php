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
            return redirect('questions/'.$id)->with('error','sebagai pembuat anda tidak dapat down pertanyaan anda sendiri');
        }
        $data = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->first();
                        // dd($data);
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
           return redirect('questions/'.$id)->with('error','sebagai pembuat anda tidak dapat down pertanyaan anda sendiri');
        }
        $data = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id',  $id)
                        ->first();
        // dd($data);
        if($data != null) {
            if( $data->vote == 1){
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->where('answer_id', 0)
                        ->update(['vote' => -1]);
                $user->update(['point' => $point - 11]);
                // dd(3);
                return redirect('questions/'.$id);
            } else if( $data->vote == -1){
                // dd(1);
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
                        
        // dd($data);
        $userId = $data->user_id;
        if( $userId == Auth::id()){
            return redirect('questions/' . $data->question_id)->with('error','sebagai pembuat anda tidak dapat down pertanyaan anda sendiri');
        }
        $dataReputasi = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('answer_id','=',$id)
                        ->first();
                        // dd($data);
            
        
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
        $user->update(['point' => 10]);
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
            return redirect('questions/' . $data->question_id)->with('error','sebagai pembuat anda tidak dapat down pertanyaan anda sendiri');
        }
        $dataReputasi = DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('answer_id','=',$id)
                        ->first();
                        // dd($data);
            
    
        if($dataReputasi != null) {
            if( $dataReputasi->vote == -1){
                return redirect('questions/' . $dataReputasi->question_id)->with('error','Anda hanya dapat melakukan sekali seumur hidup :(');
            } else if( $dataReputasi->vote == 1){
                // DB::table('user_points')->insert(['user_id' => $userId,'point'=> -11]);
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
            // DB::table('user_points')->insert(['user_id' => $userId,'point'=> 10]);
        $user->update(['point' => $point -1]);
        return redirect('questions/' . $data->question_id);
    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function get()
    {
        $data = DB::table('reputasions')->get();
        return $data;
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
     * @param  \App\Reputasion  $reputasion
     * @return \Illuminate\Http\Response
     */
    public function show(Reputasion $reputasion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reputasion  $reputasion
     * @return \Illuminate\Http\Response
     */
    public function edit(Reputasion $reputasion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reputasion  $reputasion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reputasion $reputasion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reputasion  $reputasion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reputasion $reputasion)
    {
        //
    }
}
