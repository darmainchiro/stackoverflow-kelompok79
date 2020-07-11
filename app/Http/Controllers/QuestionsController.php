<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Answer;
use App\Http\Controllers\ReputasionsController;
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

        $questions = DB::table('questions')
                    ->get();
        // dd($questions);
        return view('pertanyaan.index', compact('questions'));
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required'
        ]);

        $user = Auth::user();
        $waktu = time();
        // ! Cara pertama
        Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user['id'],
            'tags' => $request->tags,
            'waktu_buat' => $waktu
        ]);

        // // ! Cara kedua
        // $question = new Question;
        // $question->title = $request->title;
        // $question->content = $request->content;
        // $question->tags = $request->tags;
        // // $question->user_id = $user['id']; // Ini cara biasa buat hubungin fk si user
        // $question->user()->associate($user); // Ini cara kalo menggunakan eloquent relationship yg sifatnya "belongs to"
        // $question->save();



        return redirect()->route('questions.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public static function show(Question $question)
    {
          
          $answers = DB::table('answers')
            ->join('users', 'users.id', '=', 'answers.user_id')
            ->select('answers.*', 'users.name as name')
            ->get();
          $comments = DB::table('answer_comment')->get();
          $reputasis = DB::table('reputasions')
                        ->where('question_id',$question->id)
                        ->get();
          // dump($question);
          $questions = DB::table('questions')
                        ->where('questions.id', $question->id)
                        ->join('users','questions.user_id', 'users.id')
                        ->select('questions.*','users.name as name','users.point as point')
                        ->first();
        // dd($questions[0]->created_at);||
                        // dd($questions);
        return view('pertanyaan.detail', compact('questions','answers','comments','reputasis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required'
        ]);

        $user = Auth::user();
        $question->user()->associate($user);
        $question->update($request->all());

        return redirect('questions/' . $question->id)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Data berhasil dihapus');
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

        return redirect()->route('questions.show', $id)->with('success', 'Komen berhasil ditambah');
    }
}
