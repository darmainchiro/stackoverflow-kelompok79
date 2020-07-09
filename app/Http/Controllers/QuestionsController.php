<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $datas = DB::table('users')
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'users.email as email')
            ->get();
        return view('index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Question::create([
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'tag' => $request->tag,
        //     'vote' => 0,
        // ]);
        // ISTIRIHAT DISINI MAGHRIB
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('pertanyaan.detail', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $question = DB::table('users')
            ->join('questions', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'users.email as email', 'users.id as user_id')
            ->get();
        return view('pertanyaan.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // dd($question);
        Question::where('id', $question->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        return redirect('/pertanyaan/' . $question->id . '/' . $question->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Question::destroy($question->id);
        return redirect('/');
    }

    public function getComment($id)
    {
        $userId = Auth::id();

        $questions = Question::where('id', $id)
            ->where('user_id', $userId)
            ->with('comments')
            ->get();
        return $questions;
    }

    public function createComment(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $user = Auth::id();

        $this->validate($request, [
            'comment' => 'required'
        ]);

        $question->comments()->attach([
            $user => [
                'comment' => $request->comment
            ]
        ]);

        return $question;
    }
}
