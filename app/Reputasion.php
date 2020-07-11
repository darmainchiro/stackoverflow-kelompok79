<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reputasion extends Model
{
    public static function getOne($kolom,$acuan)
    {
    	$result = DB::table('reputasions')->where($kolom,$acuan)->get();
    	return $result;
    }
    public static function getAll()
    {
    	$result = DB::table('reputasions')->get();
    	return $result;
    }
}

