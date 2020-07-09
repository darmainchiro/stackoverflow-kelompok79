<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->belongsToMany(User::class, 'question_comment', 'question_id', 'user_id')->withPivot('comment')->withTimestamps();
    }
}
