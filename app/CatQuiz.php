<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatQuiz extends Model
{
    protected $guarded = [];
    public  function asks()
    {
        return $this->hasMany(AskQuiz::class);
    }

    public  function asks15()
    {
        return $this->hasMany(AskQuiz::class)->limit(15)->inRandomOrder();
    }
}
