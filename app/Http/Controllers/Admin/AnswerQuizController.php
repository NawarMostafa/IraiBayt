<?php

namespace App\Http\Controllers\Admin;

use App\AnswerQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }
    public function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $answers = AnswerQuiz::where(function ($query) use ($q) {
            $query->where('answer', 'like', "%$q%");
            $query->orWhereHas('ask', function ($query) use ($q) {
                $query->where('ask', 'like', "%$q%");
            });
        })->orderBy('ask_quiz_id', 'desc')->with(['ask'])->latest()->paginate(10);
        return $answers;
    }

    public function show($id)
    {
        return AnswerQuiz::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'answer' => 'required'
        ], [
            'answer.required' => 'يرجى كتابة الإجابة'
        ]);
        $answer = AnswerQuiz::find($request->id);
        $answer->update([
            'answer' => $request->answer,
            'right' => $request->right,
        ]);
    }
}
