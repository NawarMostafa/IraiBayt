<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerQuiz extends Model
{
    protected $guarded = [];
    public function ask()
    {
        return $this->belongsTo(AskQuiz::class, 'ask_quiz_id');
    }
}
