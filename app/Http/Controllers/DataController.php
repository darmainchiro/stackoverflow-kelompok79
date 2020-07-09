<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function questions()
    {
        $questions = Question::with('user', 'answers')->get();

        return datatables()->of($questions)
            ->addColumn('action', 'pertanyaan.action')
            ->addIndexColumn()
            ->toJson();
    }
}
