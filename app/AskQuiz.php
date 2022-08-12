<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskQuiz extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(CatQuiz::class, 'cat_quiz_id');
    }

    public function answers()
    {
        return $this->hasMany(AnswerQuiz::class);
    }
}
