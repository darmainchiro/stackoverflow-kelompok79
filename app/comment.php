<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class comment extends Model
{
    public static function getAll()
    {
    	$result = DB::table('answer_comment')->get();
    	return $result;
    }
    public static function getIf($question_id)
    {
    	$result = DB::table('answer_comment')->where('question_id',$question_id)->get();
    }
}
