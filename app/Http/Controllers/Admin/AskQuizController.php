<?php

namespace App\Http\Controllers\Admin;

use App\AnswerQuiz;
use App\AskQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AskQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'ask' => 'required',
            'cat_quiz_id' => 'required'
        ], [
            'ask.required' => 'يجب إضافة سؤال',
            'cat_quiz_id.required' => 'يرجى تحديد القسم'
        ]);
        $ask = AskQuiz::create([
            'ask' => $request->ask,
            'time' => $request->time,
            'cat_quiz_id' => $request->cat_quiz_id
        ]);

        AnswerQuiz::create([
            'answer' => $request->ans1,
            'right' => $request->ans1right,
            'ask_quiz_id' => $ask->id,
        ]);
        AnswerQuiz::create([
            'answer' => $request->ans2,
            'right' => $request->ans2right,
            'ask_quiz_id' => $ask->id,
        ]);
        AnswerQuiz::create([
            'answer' => $request->ans3,
            'right' => $request->ans3right,
            'ask_quiz_id' => $ask->id,
        ]);
        AnswerQuiz::create([
            'answer' => $request->ans4,
            'right' => $request->ans4right,
            'ask_quiz_id' => $ask->id,
        ]);

        $id = $request->cat_quiz_id;
        $alert = 'تم إضافة السؤال بنجاح';
        return view('admin.quiz.ask', compact('id', 'alert'));
    }
    public  function getAll(Request $request)
    {
        // return "tt";
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;

        $countries = AskQuiz::where(function ($query) use ($q) {
            $query->where('ask', 'like', "%$q%");
            $query->orWhereHas('category', function ($query1) use ($q) {
                $query1->where('name', 'like', "%$q%");
            });
        })->with(['category'])->latest()->paginate(10);
        return $countries;
    }

    public function show($id)
    {
        return AskQuiz::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'ask' => 'required',
        ], [
            'ask.required' => 'يجب إضافة سؤال',
        ]);
        AskQuiz::find($request->ask_id)->update([
            'ask' => $request->ask,
            'time' => $request->time,

        ]);

        $answer = AnswerQuiz::find($request->ans1_id);
        $answer->update([
            'answer' => $request->ans1,
            'right' => $request->ans1right,
        ]);

        $answer = AnswerQuiz::find($request->ans2_id);
        $answer->update([
            'answer' => $request->ans2,
            'right' => $request->ans2right,
        ]);

        $answer = AnswerQuiz::find($request->ans3_id);
        $answer->update([
            'answer' => $request->ans3,
            'right' => $request->ans3right,
        ]);

        $answer = AnswerQuiz::find($request->ans4_id);
        $answer->update([
            'answer' => $request->ans4,
            'right' => $request->ans4right,
        ]);


        $AskQuiz = AskQuiz::find($request->ask_id);

        $id = $AskQuiz->cat_quiz_id;
        $alert = 'تم تعديل السؤال بنجاح';
        return view('admin.quiz.ask', compact('id', 'alert'));
    }

    public function delete($id)
    {
        $ask = AskQuiz::find($id);

        $id = $ask->cat_quiz_id;

        $ask->answers()->delete();
        $ask->delete();


        $alert = 'تم حذف السؤال بنجاح';
        return view('admin.quiz.ask', compact('id', 'alert'));
    }

    public function editask($id)
    {
        return view('admin.quiz.editask', compact('id'));
    }
}
