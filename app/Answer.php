<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public static function get($id)
    {
    	$result = DB::table('answers')->where('id', $id)->first();
    	return $result;
    }
    public static function updateOne($data,$id)
    {
    	DB::table('answers')->where('id',$id)->update($data);
    }
}
