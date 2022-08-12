<?php

namespace App\Http\Controllers\Site;

use App\AnswerQuiz;
use App\AskQuiz;
use App\CatQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function category()
    {
        $quizies = CatQuiz::all();

        return view('site.quiz', compact('quizies'));
    }
    public function quizz($id)
    {
        $quizies = CatQuiz::all();
        return view('site.quizAsk', compact('id', 'quizies'));
    }
    public function asks($id)
    {
        $c = CatQuiz::where('id', $id)->with('asks15')->first();
        return $c;
    }
    public function getanswers($id)
    {


        return AnswerQuiz::where('ask_quiz_id', $id)->get();
    }

    //-------------API-----------------

    public function category_api()
    {
        return CatQuiz::all();
    }
}
