<?php

namespace App\Http\Controllers;

use App\Reputasion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ReputasionsController extends Controller
{


    public function upvote($id)
    {
        $userId = DB::table('questions')->where('id',$id)->first();
        $userId = $userId->user_id;
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
                DB::table('user_points')->insert(['user_id' => $userId,'point'=> 11]);
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->update(['vote' => 1]);
                return redirect('questions/'.$id);
            } 
        }
        DB::table('reputasions')->insert([
                'question_id' => $id,
                'user_id' => Auth::id(),
                'vote' => 1.
            ]);
            DB::table('user_points')->insert(['user_id' => $userId,'point'=> 10]);
        return redirect('questions/'.$id);  
    }
    public function downvote($id)
    {
        $userId = DB::table('questions')->where('id',$id)->first();
        $userId = $userId->user_id;
        if( $userId == Auth::id()){
           return redirect('questions/'.$id)->with('error','sebagai pembuat anda tidak dapat down pertanyaan anda sendiri');
        }
        $data = DB::table('reputasions')->where('user_id','=',Auth::id())->first();
        
        if($data != null) {
            if( $data->vote == 1){
                DB::table('reputasions')
                        ->where('user_id','=',Auth::id())
                        ->where('question_id','=',$id)
                        ->update(['vote' => -1]);
                DB::table('user_points')->insert(['user_id' => $userId,'point'=> -11]);
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
        DB::table('user_points')->insert(['user_id' => $userId,'point'=> -1]);
        return redirect('questions/'.$id);
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
