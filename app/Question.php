<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function comments()
    {
        return $this->belongsToMany(User::class, 'question_comment', 'question_id', 'user_id')->withPivot('comment')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function getAll()
    {
        $result = DB::table('questions')->get();
        return $result;
    }
}
